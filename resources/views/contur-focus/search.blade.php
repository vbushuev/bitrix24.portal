@extends('layouts.master')
@section('title', 'Contur-Focus::search')
@section('sidebar')

@endsection
@section('content')
    <div class="title">
        Contur-focus<sup>0.1</sup>
    </div>
    <div class="form">
		<form method="post">
			{{ csrf_field() }}
			<input id="search" name="search" placeholder="search"/>
			<button type="submit">search</button>
		</form>
    </div>
	<p>
		{{isset($posted) ? $posted : ""}}
	</p>
@endsection
