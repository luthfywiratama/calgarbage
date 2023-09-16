@extends('layouts.admin')


@section('content')
<div class="container my-5">
    @include('includes.admin.flash-message')
    <div class="card">
        <div class="card-body">
            <button data-bs-toggle="modal" data-bs-target="#addModal" type="button" class="btn btn-primary mb-2">Add
                Type</button>
            <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 80px;">No</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>color</th>
                        <th>Description</th>
                        <th>Photo</th>
                        <th>#</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ number_format($item->price) }}</td>
                        <td>{{ $item->color }}</td>
                        <td>{{ $item->description }}</td>
                        <td>
                            @if ($item->photo)
                            <img src="{{ asset($item->photo) }}" width="50px" alt="">
                            @endif
                        </td>
                        <td>
                            <div class="action-btn d-flex">
                                <a href="#" data-bs-toggle="modal" data-bs-target="#editModal"
                                    data-route="{{ route('admin.garbage-type.update',$item->id) }}"
                                    data-name="{{ $item->name }}" data-description="{{ $item->description }}"
                                    data-photo="{{ asset($item->photo) }}" data-color="{{ $item->color }}" data-price="{{ $item->price }}" class="text-primary btn-edit px-2"><i
                                        class="fas fa-edit"></i></a>
                                <a href="#" data-bs-toggle="modal" data-bs-target="#modal_delete"
                                    data-route="{{ route('admin.garbage-type.destroy',$item->id) }}"
                                    class="text-danger btn-delete px-2"><i class="fas fa-trash"></i></a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection


<!-- Modal Body -->
<!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
<div class="modal fade" id="addModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
    aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">Add Type</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.garbage-type.store') }}" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" required >
                        @if (session()->has('error-create') && $errors->has('name'))
                        <small class="text-danger">{{ $errors->first('name') }}</small>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Price/KG</label>
                        <input type="number" class="form-control" name="price" required >
                        @if (session()->has('error-create') && $errors->has('price'))
                        <small class="text-danger">{{ $errors->first('price') }}</small>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Color</label>
                        <input type="color" class="form-control" name="color" required >
                        @if (session()->has('error-create') && $errors->has('price'))
                        <small class="text-danger">{{ $errors->first('price') }}</small>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" name="description" required > </textarea>
                        @if (session()->has('error-create') && $errors->has('description'))
                        <small class="text-danger">{{ $errors->first('description') }}</small>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="icon" class="form-label">Photo</label>
                        <input type="file" class="form-control" name="photo">
                        @if (session()->has('error-create') && $errors->has('photo'))
                        <small class="text-danger">{{ $errors->first('photo') }}</small>
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="editModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
    aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">Edit Type</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="#" id="form_modal_edit" enctype="multipart/form-data" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" id="name" required >
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Price/KG</label>
                        <input type="number" class="form-control" name="price" id="price" required >
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">color</label>
                        <input type="color" class="form-control" name="color" id="color" required >
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi</label>
                        <textarea class="form-control" name="description" id="description" > </textarea>
                    </div>
                    <div class="mb-3">
                        <img src="" id="photo" width="100" class="d-block" alt="">
                        <label for="photo" class="form-label">Photo</label>
                        <input type="file" class="form-control" name="photo">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>



<div id="modal_delete" class="modal fade" tabindex="-1" aria-labelledby="danger-header-modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header modal-colored-header bg-danger text-white">
                <h4 class="modal-title" id="danger-header-modalLabel">Delete Data
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" id="form_modal_delete" method="post">
                @csrf
                @method('delete')
                <div class="modal-body">
                    <p class="text-center">Anda Yakin delete data ini?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-light-danger text-danger font-weight-medium">Delete !</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>


@push('js')

<script>
    $(document).on('click', '.btn-delete', function () {
        var route = $(this).data("route");
        $('#form_modal_delete').attr('action', route);
    });
    $(document).on('click', '.btn-edit', function () {
        var route = $(this).data("route");
        var name = $(this).data("name");
        var price = $(this).data("price");
        var color = $(this).data("color");
        var photo = $(this).data("photo");
        var description = $(this).data("description");
        $('#form_modal_edit').attr('action', route);
        $('#name').val(name);
        $('#price').val(price);
        $('#color').val(color);
        $('#description').val(description);
        $('#photo').attr('src', photo);
    });
</script>
@endpush
