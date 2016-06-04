<?php

namespace Comproso\Elements\Collection\Models;

use Illuminate\Database\Eloquent\Model;

use Request;
use Session;
use Validator;
use View;

use Comproso\Framework\Traits\ModelTrait;
use Comproso\Framework\Contracts\ElementContract;

class ContentElement extends Model implements ElementContract
{
    use ModelTrait;

    // explanation table
    protected $table = 'content_elements';

    // mass assignable (blacklist)
    protected $guarded = [];

	// Item model
    public function items()
    {
	    return $this->morphMany($this->ItemModel, 'element');
    }

	// model implementation
	public function implement($data)
	{
		// input validation
		/*$validator = Validator::make($data->toArray(), [
			'position' => 'integer',
			'headline' => 'string',
			'label' => 'string',
			'type' => 'cetype|required',
			'html' => 'string',
			'form_input_type' => "input_type|required_if:type,input",
			'form_params' => 'json',
			'form_options' => 'json',
			#'cssid' => 'alpha_dash',
			#'cssclass' => 'alpha_dash'
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
		}*/

		// set element type
		$this->type = $data->type;

		// set attributes
		$this->html_attributes = (isset($data->html_attributes)) ? $data->html_attributes : null;

		if($this->type == "text")
		{
			$this->html = $data->html;
		}
		elseif($data->type == "input")
		{
			// set form input type
			$this->form_input_type = $data->form_input_type;

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

		// successfully created
		return true;
	}

    // model generation
    public function generate($cache = null)
    {
	    // prepare result
	    $result = new ContentElement;

	    // set attributes
	    $result->html_attributes = (is_null($this->html_attributes)) ? [] : json_decode($this->html_attributes);

		// get the type
		if($this->type == "text")
			$result->content = $this->html;
		elseif($this->type == "input")
		{
			if(($this->form_input_type !== "radio") AND ($this->form_input_type !== "checkbox"))
			{
				$result->label = $this->label;
				$result->type = $this->form_input_type;
				$result->params = (is_null($this->form_params)) ? [] : json_decode($this->form_params, true);
				$result->value = $cache;
			}
			else
			{
				$result->label = $this->label;
				$result->type = $this->form_input_type;
				$result->options = (is_null($this->form_options)) ? [] : json_decode($this->form_options, true);
				$result->value = $cache;
			}
		}
		elseif($this->type == "textarea")
		{
			//
		}
		elseif($this->type == "wrapper")
		{
			$result->tag = $this->html_tag;
		}
		else
		{
			// no valid type
			return null;
		}

		return $result;
    }

    // model proceeding
    public function proceed()
    {
	    if($this->type === "text")
	    	return null;

		// get value
		$value = Request::get('item'.$this->item_id);

		// get validation rules
		$validation = (isset($this->form_validation)) ? $this->form_validation : "alpha_dash";

		// validate
	    $validator = Validator::make(['val' => $value], ['val' => $validation]);

		// abort if validation fails
	    if($validator->fails())
	    {
	    	\Log::error('Validation of Item (CE-ID: '.$this->id.') input failed');
			return null;
		}

	    return $value;
    }

    // model default template
    public function template()
    {
	    switch($this->type)
	    {
		    case "text":
		    	return "eco::text";

		    	break;
		    case "input":
		    	if(($this->form_input_type == "radio") OR ($this->form_input_type == "checkbox"))
		    		return "eco::radiocheckbox";
		    	else
		    		return "eco::input";

		    	break;
		    case "textarea":
		    	break;
		    case "wrapper":
		    	if($this->wrapper_type == "begin")
		    		return "eco::wrappers.begin";
		    	else
		    		return "eco::wrappers.end";
		    	break;
	    }
    }
}
