@extends('layouts.check_quick_plan_layout',array('1'=>'1'))
@section('content')
<head>
    <script>
        function XML2jsobj(node) {

            var data = {};

            // append a value
            function Add(name, value) {
                if (data[name]) {
                    if (data[name].constructor != Array) {
                        data[name] = [data[name]];
                    }
                    data[name][data[name].length] = value;
                } else {
                    data[name] = value;
                }
            }
            ;

            // element attributes
            var c, cn;
            for (c = 0; cn = node.attributes[c]; c++) {
                Add(cn.name, cn.value);
            }

            // child elements
            for (c = 0; cn = node.childNodes[c]; c++) {
                if (cn.nodeType == 1) {
                    if (cn.childNodes.length == 1 && cn.firstChild.nodeType == 3) {
                        // text value
                        Add(cn.nodeName, cn.firstChild.nodeValue);
                    } else {
                        // sub-object
                        Add(cn.nodeName, XML2jsobj(cn));
                    }
                }
            }

            return data;

        }

        console.log(XML2jsobj('http://notams.euroutepro.com/notams.xml'))
    </script>
</head>
<div class="container">
    <div class="row">
	<section>
	    <div class="col-sm-8 col-sm-offset-2">
		<div class="page-header">
		    <h2>Test</h2>
		</div>

	    </div>
	</section>
    </div>
</div>

@stop
