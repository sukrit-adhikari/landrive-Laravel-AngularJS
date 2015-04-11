<!--/**-->
<!-- * Created by PhpStorm.-->
<!-- * User: Sukrit-->
<!-- * Date: 4/10/15-->
<!-- * Time: 8:34 PM-->
<!-- */-->

@foreach ($config as $configName => $configValue)
    @if(gettype($configValue) == 'boolean')
      {{ Form::checkbox($configName, 'value', true)}}
    @endif
@endforeach