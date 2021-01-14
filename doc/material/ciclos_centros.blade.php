@extends('layouts.master')

@section('content1')
<br>
<p class="description" style="font-size:30px;">
<b>Ciclos formativos y centros</b>
</p>
@endsection

<br>


@section('content2')
<ul class="accordion1">
  
@foreach ($entidad as $ent)
  <li class="dencuali" data-type="dencuali">
    <a class="toggle1 enlaces" data-type="titulo" href="javascript:void(0);">{{ $ent['codigo'] }}-{{ $ent['denominacion'] }}-{{ $ent['grado'] }}</a>
        <div class="inner">
	  <p>
			@foreach ($ent['children'] as $ech)
			{{ $ech['codigo'] }}
			<br>
			{{ $ech['tipo'] }}
			{{ $ech['id'] }}
			{{ $ech['dir'] }}
			{{ $ech['prov'] }}
			{{ $ech['loc'] }}
			{{ $ech['tel'] }}
			{{ $ech['mail'] }}
			<br>
			
			@endforeach 
	  </p>
        </div>
      
      
  </li>
@endforeach 
  
</ul>

@stop
