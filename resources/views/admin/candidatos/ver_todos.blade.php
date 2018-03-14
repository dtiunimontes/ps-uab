@extends('layouts.app')

@section('title', 'Todos os Candidatos')
@section('content')

@push('scripts')
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables/datatables.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap-sweetalert/sweetalert.css') }}">
<script type="text/javascript" src="{{ asset('assets/plugins/datatables/datatables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/bootstrap-sweetalert/sweetalert.min.js') }}"></script>

<script type="text/javascript">
$('#candidatos').DataTable({
	processing: true,
	serverSide: true,
	"autoWidth": true,
	ajax: '{{ route('admin.candidatos.ver_todos') }}',
	columns: [
		// {data: 'id', name: 'id'},
		{data: 'nome', name: 'nome'},
		{data: 'cpf', name: 'cpf'},
		{data: 'email', name: 'email'},
		{data: 'modalidade', name: 'modalidade'},
		{data: 'status', name: 'status'},
		{data: 'action', name: 'action', orderable: false, searchable: false}
	],
	"language": {
		url: '//cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Portuguese.json'
	}
});
</script>
<script type="text/javascript">
	$(document).on("click", "[data-excluir]", function (e) {
		e.preventDefault();
		var $this = $(this);
		var nome = $this.attr('data-excluir');
		swal({
			title: "Você tem certeza?",
			text: 'Todos os dados de <strong>"'+nome+'"</strong> serão apagados e não é possível recuperar.',
			html:true,
			type: "warning",
			showCancelButton: true,
			confirmButtonClass: "btn red",
			confirmButtonText: "Sim, exclua!",
			cancelButtonText: "Cancelar",
			closeOnConfirm: false,
			closeOnCancel: true
		},
		function(isConfirm) {
			if (isConfirm) {
				$this.closest('form').submit();
				swal("Excluindo!", "O usuário será excluído", "success");
			}
		});
	});
</script>
@endpush

<div class="portlet-body">
	<table class="table table-striped table-bordered table-hover order-column" id="candidatos">
		<thead>
			<tr>
				<th> Nome </th>
				<th> CPF </th>
				<th> Email </th>
				<th> Modalidade </th>
				<th> Situação </th>
				<th> Ações </th>
			</tr>
		</thead>
	</table>
</div>

@endsection
