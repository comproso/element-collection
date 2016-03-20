<?php

namespace Comproso\Elements\Collection\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

use Cache;
use Validator;
use View;

use Comproso\Framework\Traits\ModelTrait;
use Comproso\Framework\Contracts\ElementContract;

class ContentElement extends Model implements ElementContract
{
    use ModelTrait;

    // explanation table
    protected $table = 'content_elements';

    // mass assignable (whitelist)
    protected $fillable = [];

	// Item model
    public function items()
    {
	    return $this->morphMany($this->ItemModel, 'element');
    }

	// model implementation
	public function implement($data)
	{
		// input validation
		$validator = Validator::make($data->toArray(), [
			'position' => 'integer',
			'headline' => 'string',
			'label' => 'string',
			'type' => 'cetype|required',
			'html' => 'string',
			'form_input_type' => "input_type|required_if:type,input",
			'form_params' => 'json',
			'form_options' => 'json',
			'cssid' => 'alpha_dash',
			'cssclass' => 'alpha_dash'
		]);

		$validator->sometimes('form_name', 'alpha_dash|required', function ($input) {
			return (($this->type == "input") OR ($this->type == "textarea"));
		});

		$validator->sometimes('html_tag', 'string|required', function ($input) {
			return ($this->type == "wrapper");
		});

		// validation fail
		if($validator->fails())
		{
			\Log::error($validator->errors());
			return false;
		}

		// set element type
		$this->type = $data->type;

		if($this->type == "text")
		{
			$this->html = $data->html;
		}
		elseif($data->type == "input")
		{
			$this->form_name = $data->form_name;

			// set form input type
			$this->form_input_type = $data->form_input_type;

			if(isset($data->form_params))
				$this->form_params = $data->form_params;

			if(isset($data->form_options))
				$this->form_options = $data->form_options;

			if(isset($data->label))
				$this->label = $data->label;
		}
		elseif($data->type == "wrapper")
		{
			$this->html_tag = $data->html_tag;
			$this->wrapper_type = $data->wrapper_type;
		}
		else
		{
			// error
			return false;
		}

		// set template
		if(isset($data->template))
			$this->template = $data->template;

		// set css
		if(isset($data->cssid))
			$this->cssid = $data->cssid;

		if(isset($data->cssclass))
			$this->cssclass = $data->cssclass;

		// successfully created
		return true;
	}

    // model generation
    public function generate($cache = null)
    {
	    // prepare view
	    $view = "";

		// get the type
		if($this->type == "text")
		{
			if($this->template === null)
				$this->template = "eco::text";

			$view = View::make($this->template, [
				'content'	=> $this->html,
				'cssid'		=> $this->cssid,
				'cssclass'	=> $this->cssclass
			])->render();
		}
		elseif($this->type == "input")
		{
			if(($this->form_input_type !== "radio") AND ($this->form_input_type !== "checkbox"))
			{
				if($this->template === null)
					$this->template = "eco::input";

				$view = View::make($this->template, [
					'label'		=> $this->label,
					'type'		=> $this->form_input_type,
					'name'		=> $this->form_name,
					'params'	=> json_decode($this->form_params, true),
					'cssid'		=> $this->cssid,
					'cssclass'	=> $this->cssclass,
					'value'		=> $cache
				])->render();
			}
			else
			{
				if($this->template === null)
					$this->template = "eco::radiocheckbox";

				$view = View::make($this->template, [
					'label'		=> $this->label,
					'type'		=> $this->form_input_type,
					'name'		=> $this->form_name,
					'options'	=> json_decode($this->form_options, true),
					'cssid'		=> $this->cssid,
					'cssclass'	=> $this->cssclass,
					'value'		=> $cache
				])->render();
			}
		}
		elseif($this->type == "textarea")
		{
			//
		}
		elseif($this->type == "wrapper")
		{
			if($this->template === null)
				$this->template = ($this->wrapper_type == 'begin') ? 'eco::wrappers.begin' : 'eco::wrappers.end';

			$view = View::make($this->template, [
				'tag' => $this->html_tag
			])->render();
		}
		else
		{
			// no valid type
			return false;
		}

		return $view;
    }

    // model proceeding
    public function proceed($request)
    {
	    if($this->type === "text")
	    	return null;

	    $validator = Validator::make($request->toArray(), [$this->form_name => $this->form_validation]);

	    if($validator->fails())
	    {
	    	\Log::error('Validation of Item (CE-ID: '.$this->id.') input failed');
			return false;
		}

	    return $request->input($this->form_name);
    }
}
