<span class="form-name">{{$title}}</span>
<input type="text" class="input-form {{$class}} money" name="{{$name}}"  onKeyUp="mascaraMoeda(this, event)" placeholder="{{$placeholder}}" value="{{$value}}">
<p class="texterror {{$validation}}_error"></p>


<script src="{{asset('/assets/js/format-money.js')}}">
</script>


