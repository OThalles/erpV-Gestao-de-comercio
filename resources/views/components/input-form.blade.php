<span class="form-name">{{$title}}</span>
<input type="text" class="input-form {{$class}}" name="{{$name}}" placeholder="{{$placeholder}}" value="{{$value}}" {{$readonly ? 'readonly':''}}>
<p class="texterror {{$validation}}_error"></p>
