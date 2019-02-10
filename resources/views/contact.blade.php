@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Contact</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if(!(isset($showcontact)))
                    <form action="{{ URL::route('contact.store') }}" method="POST">
                        @csrf
                        @if($errors)
                            <label class="text text-danger"> {{ $errors->first('phone') }}</label>
                        @endif
                        <div class="form-group">
                            <label>name</label>
                            <input type="text" name="name" class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label>Phone Number</label>
                            <input type="text" name="phone" class="form-control"/>
                        </div>                        
                        <button type="submit"> Save</button>
                    </form><br>
                    @endif
                     @if(isset($contacts))
                    <h3>Contact List</h3>
                    <div class="table-responsive m-t-40">
                    <table id="contact" class="display table table-hover table-striped table-bordered contact">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Phone Number</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($contacts as $key => $contact)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $contact->name }}</td>
                                <td>{{ $contact->phone }} </td>
                                <td>{{ $contact->created_at->diffForHumans() }}</td>
                                <td><a href="{{ URL::route('contact.edit',$contact->id)}}">Edit</a> &nbsp;&nbsp;<a href="{{ URL::route('contact.delete',$contact->id)}}">Delete</a></td>
                            </tr>                            
                            @endforeach
                        </tbody>
                    </table>
                    </div>
                    @endif
                    @if(isset($showcontact))
                        <form action="{{ URL::route('contact.update') }}" method="PATCH">
                            @csrf
                            @if($errors)
                                <label class="text text-danger"> {{ $errors->first('phone') }}</label>
                            @endif
                            <div class="form-group">
                                <label>name</label>
                                <input type="hidden" name="id" value="{{ $showcontact->id }}" class="form-control"/>
                                <input type="text" name="name" value="{{ $showcontact->name }}" class="form-control"/>
                            </div>
                            <div class="form-group">
                                <label>Phone Number</label>
                                <input type="text" name="phone" value="{{ $showcontact->phone }}" class="form-control"/>
                            </div>                        
                            <button type="submit"> Save</button>
                        </form><br>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<script>
        $(document).ready( function () {
            $('#contact').DataTable();
        } );
</script>
@endsection
