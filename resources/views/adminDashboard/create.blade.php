@extends('indexDashboard')

@section('content')

<div class="editMercant">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<h3 class="text-center">Create Merchant</h3>

				<form method="post" action="{{ route('addMerchant') }}" enctype="multipart/form-data">
				@csrf
					<div class="form-group">
					    <label>Nama Barang</label>
					    <input type="text" name="namaBarang" class="form-control {{ $errors->has('namaBarang') ? 'is-invalid' : '' }}" placeholder="Nama barang" value="{{ old('namaBarang') }}">
						@if($errors->has('namaBarang'))
	                    <span class="invalid-feedback">{{ $errors->first('namaBarang') }}</span>
	                    @endif
					</div>

				    <div class="form-group">
					      <label>Kategori</label>
					      <select name="kategori" class=" {{ $errors->has('kategori') ? 'is-invalid' : '' }}">
					      	<option value="{{ old('kategori') }}">--Pilih Kategori--</option>
					      	@foreach($categories AS $category)
					      	<option value="{{ $category->id }}">{{ $category->name_category }}</option>
					      	@endforeach
					      </select>
						@if($errors->has('kategori'))
							<span class="invalid-feedback">{{ $errors->first('kategori') }}</span>
						@endif
				    </div>

					<div class="form-group">
					    <label>Harga Barang</label>
					    <input type="text" name="hargaBarang" class="form-control {{ $errors->has('hargaBarang') ? 'is-invalid' : '' }}" placeholder="Harga Barang" value="{{ old('hargaBarang') }}" min="0">
						@if($errors->has('hargaBarang'))
							<span class="invalid-feedback">{{ $errors->first('hargaBarang') }}</span>
						@endif
					</div>

					<div class="form-group">
					    <label>Quantity</label>
					    <input type="number" name="qty" class="form-control {{ $errors->has('qty') ? 'is-invalid' : '' }}" placeholder="Quantity" value="{{ old('qty') }}">
						@if($errors->has('qty'))
							<span class="invalid-feedback">{{ $errors->first('qty') }}</span>
						@endif
					</div>

					<div class="form-group">
					    <label>Description</label>
					    <textarea name="description" class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" placeholder="Description">{{ old('description') }}</textarea>
						@if($errors->has('description'))
							<span class="invalid-feedback">{{ $errors->first('description') }}</span>
						@endif
					</div>

				    <div class="form-group">
						<select name="status">
					      	<option value="1">Active</option>
							<option value="0">Not Active</option>
					    </select>
				    </div>

				    <div class="form-group">
						<input type="file" name="file" class="form-control {{ $errors->has('file') ? 'is-invalid' : '' }}">
				    </div>

				    @if($errors->has('description'))
						<span class="invalid-feedback">{{ $errors->first('file') }}</span>
					@endif
				  
	
				    <div class="form-group row col-md-8 offset-md-4">
				  		<button type="submit" class="btn btn-primary">Create</button>
				  	 	<a href="{{ route('listMerchant') }}" class="btn btn-warning ml-2">Back</a>
				    </div>
				</form>

			</div>
		</div>
	</div>
</div>

@endsection