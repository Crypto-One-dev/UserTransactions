@extends('layout/main')
@section('content')

<div class="container">
    @if (session('status'))
        <div class="alert alert-success">
            <span> {{ session('status') }} </span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if (session('fail_status'))
        <div class="alert alert-danger">
            <span> {{ session('fail_status') }} </span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="mt-4 fw-bold">Upload Transactions File</div>
    <form action="{{route('upload_csv')}}" method="post" enctype='multipart/form-data'>
        {{ csrf_field() }}
        <fieldset>
            <div class="card p-4 mb-4t">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label>Transactions File (*.csv) </label>
                            <br>
                            <input type="file" accept=".csv" name="txt_file" required/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary col-xs-12 .col-md-8" value="Save"/>
                        </div>
                    </div>
                </div>
            </div>
        </fieldset>
    </form>                
</div>

@endsection