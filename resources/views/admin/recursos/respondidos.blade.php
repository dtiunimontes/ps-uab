@extends('layouts.app')

@section('title', 'Recursos Respondidos')
@section('content')

@push('scripts')
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables/datatables.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap-sweetalert/sweetalert.css') }}">
<script type="text/javascript" src="{{ asset('assets/plugins/datatables/datatables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/bootstrap-sweetalert/sweetalert.min.js') }}"></script>

<script type="text/javascript">
$('#recursos').DataTable({
	processing: true,
	serverSide: true,
	"autoWidth": true,
	ajax: '{{route('admin.recursos.respondidos.todos')}}',
	columns: [
      {data: 'id', name: 'id'},
			{data: 'nome', name: 'nome'},
			{data: 'cpf', name: 'cpf'},
      {data: 'action', name: 'action', orderable: false, searchable: false}
	],
	"language": {
			url: '//cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Portuguese.json'
	},
	"columnDefs": [
			//{ "width": "15%", "targets": 0 },
			{ "width": "40%", "targets": 1 },
  ]
});
</script>
@endpush
<div class="portlet-body">
	<table class="table table-striped table-bordered table-hover order-column" id="recursos">
		<thead>
			<tr>
				<th> ID </th>
				<th> Nome </th>
				<th> CPF </th>
				<th> Ações </th>
			</tr>
		</thead>
	</table>
</div>

@endsection
