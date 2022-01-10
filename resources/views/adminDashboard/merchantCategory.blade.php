@extends('indexDashboard')

@section('content')

<div class="merchantCategory">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				@if($message = Session::get('success'))
				<div class="alert alert-success">{{ $message }}</div>
				@endif

				<h3 class="text-center">Kategori</h3>
				<form method="post" action="{{ route('addCategory') }}">
				@csrf
					<div class="form-group">
					    <label>Nama Kategori</label>
					    <input type="text" name="kategori" class="form-control {{ $errors->has('kategori') ? 'is-invalid' : '' }}" placeholder="Nama Kategori" value="{{ old('kategori') }}">
					@if($errors->has('kategori'))
                    <span class="invalid-feedback">{{ $errors->first('kategori') }}</span>
                    @endif
					</div>
	
				    <div class="form-group row col-md-8 offset-md-4">
				  		<button type="submit" class="btn btn-primary">Tambah</button>
				    </div>
				</form>

				<table class="table table-bordered table-responsive mt-2 m-auto">
					<thead>
						<tr>
							<th>Nomor</th>
							<th>Kategori Barang</th>
							<th colspan="2"><center>Action</center></th>
						</tr>
					</thead>
					

					<tbody>
						@foreach($categories AS $category)
						<tr>
							<td>{{ $loop->iteration }}</td>
							<td>{{ $category->name_category }}</td>
							<td><button type="button" class="btn btn-success" data-toggle="modal" data-target="#editModal{{$category->id}}">Update</button></td>
							<td>
								<form action="{{ route('deleteCategory', $category->id) }}" method="post">
									@csrf
									<button class="btn btn-danger" type="submit" onclick="return confirm('Delete?')">Delete</button>
								</form>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>

				<div class="modal fade" id="editModal{{$category->id}}" tabindex="-1" role="dialog" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<form action="{{ route('updateCategory', $category->id) }}" method="post">
							@csrf
							<div class="modal-body">
								<div class="form-group">
									<label>Nama Kategori</label>
									<input class="form-control hidden" type="text" value="{{ $category->id }}" disabled>
									<input type="text" name="kategori" class="form-control {{ $errors->has('kategori') ? 'is-invalid' : '' }}" placeholder="Nama Kategori" value="{{ $category->name_category }}">
									@if($errors->has('kategori'))
									<span class="invalid-feedback">{{ $errors->first('kategori') }}</span>
									@endif
								</div>
							</div>
							<div class="modal-footer">
								<button class="btn btn-success" type="submit">Edit</button>
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							</div>
							</form>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>

@endsection