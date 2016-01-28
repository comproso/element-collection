<?php

namespace Comproso\Elements\Collection\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

use Comproso\Testing\Traits\ModelTrait as TestingModelTrait;
use Comproso\Testing\Traits\ElementTrait;
use Comproso\Testing\Interfaces\ElementInterface;

class HtmlElement extends Model implements ElementInterface
{
    use TestingModelTrait, ElementTrait;

    // explanation table
    protected $table = 'html_elements';

    // mass assignable (whitelist)
    protected $fillable = [];


	// Item model
    public function items()
    {
	    $this->morphMany($ItemModel, 'element');
    }

    // model generation
    public function generate()
    {
	    if($this->type == "html")
	    {
	    	return view('eco::html', [
		    	'hl'		=> $this->hl_tag,
		    	'hlcontent'	=> $this->headline,
		    	'content'	=> $this->html
	    	]);
	    }
	    elseif($this->type == "fieldset")
	    {
		    // fieldest group
		    $elements = HtmlElement::where('group_by', $this->id)->get();

		    // proceed data
		    $data = [];

		    foreach($elements as $element)
		    {
			    $data[] = $element->generate();
		    }

		    // return result
		    return view("eco::fieldset", [
			    //
		    ]);
	    }
	    elseif($this->type == "input")
	    {
		    // form input element

	    }
    }
}
