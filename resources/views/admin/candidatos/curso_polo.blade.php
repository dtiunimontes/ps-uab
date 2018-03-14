@extends('layouts.app')

@section('title', $curso->nome." em ".$polo->nome." - ".$inscricao )
@section('content')

@push('scripts')
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables/datatables.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap-sweetalert/sweetalert.css') }}">
<script type="text/javascript" src="{{ asset('assets/plugins/datatables/datatables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/bootstrap-sweetalert/sweetalert.min.js') }}"></script>

<script type="text/javascript">
curso = $('#curso').val();
polo = $('#polo').val();
inscricao = $('#inscricao').val();
$('#candidatos').DataTable({
	processing: true,
	serverSide: true,
	"autoWidth": true,
	"ajax": {
            "url": "{{ route('admin.candidatos.getCursoPolo') }}?curso_id="+curso+"&polo_id="+polo+"&inscricao="+inscricao,
            "type": "GET"
        },
	columns: [
		// {data: 'id', name: 'id'},
		{data: 'nome', name: 'nome'},
		{data: 'cpf', name: 'cpf'},
		{data: 'email', name: 'email'},
		{data: 'modalidade', name: 'modalidade'},
		{data: 'status', name: 'status'},
	],
	"language": {
		url: '//cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Portuguese.json'
	}
});
</script>
@endpush

<input type="hidden" id="curso" value="{{$curso->id}}">
<input type="hidden" id="polo" value="{{$polo->id}}">
<input type="hidden" id="inscricao" value="{{$inscricao_id}}">
<div class="portlet-body">
	<table class="table table-striped table-bordered table-hover order-column" id="candidatos">
		<thead>
			<tr>
				<th> Nome </th>
				<th> CPF </th>
				<th> Email </th>
				<th> Modalidade </th>
				<th> Situação </th>
			</tr>
		</thead>
	</table>
</div>

@endsection
