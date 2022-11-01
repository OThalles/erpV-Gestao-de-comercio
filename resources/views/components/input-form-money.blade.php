<span class="form-name">{{$title}}</span>
<input type="text" class="input-form {{$class}} money" name="{{$name}}"  onKeyUp="mascaraMoeda(this, event)" placeholder="{{$placeholder}}" value="{{$value}}">

<script>
String.prototype.reverse = function(){
  return this.split('').reverse().join('');
};

function mascaraMoeda(campo,evento){
  var tecla = (!evento) ? window.event.keyCode : evento.which;
  var valor  =  campo.value.replace(/[^\d]+/gi,'').reverse();
  var resultado  = "";
  var mascara = "##.###.###,##".reverse();
  for (var x=0, y=0; x<mascara.length && y<valor.length;) {
    if (mascara.charAt(x) != '#') {
      resultado += mascara.charAt(x);
      x++;
    } else {
      resultado += valor.charAt(y);
      y++;
      x++;
    }
  }
  campo.value = resultado.reverse();
}
</script>


