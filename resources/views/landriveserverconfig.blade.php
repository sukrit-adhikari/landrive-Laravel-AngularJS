<!--/**-->
<!-- * Created by PhpStorm.-->
<!-- * User: Sukrit-->
<!-- * Date: 4/10/15-->
<!-- * Time: 8:34 PM-->
<!-- */-->

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

@section('content')

{!! Form::open() !!}

@foreach ($config as $configName => $configData)

@if($configData['type'] == 'boolean')

  {!! Form::label($configName) !!}

  {!! Form::checkbox($configName,$configName , $configData['config'], array('class'=>'checkbox' )) !!}

@elseif($configData['type'] == 'string')

  {!! Form::label($configName) !!}

  {!! Form::textarea($configName, $configData['config'],  array('required' , 'class'=>'form-control' )) !!}

@endif



@endforeach


{!! Form::close() !!}
