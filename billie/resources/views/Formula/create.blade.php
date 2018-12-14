@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Try it for yourself</div>
				@if ($errors->any())
				      <div class="alert alert-danger">
				        <ul>
				            @foreach ($errors->all() as $error)
				              <li>{{ $error }}</li>
				            @endforeach
				        </ul>
				      </div><br />
				    @endif


                <div class="card-body">
                  	{!! Form::open(['route' => 'formula.store']) !!}

					<div class="form-group">
					    {!! Form::label('value1', 'An integer') !!}
					    {!! Form::number('value1', null, ['class' => 'form-control']) !!}
					</div>

					<div class="form-group">
					    {!! Form::label('value2', 'A float') !!}
					    {!! Form::number('value2', null, ['class' => 'form-control']) !!}
					</div>

					<div class="form-group">
					    {!! Form::label('email', 'E-mail Address') !!}
					    {!! Form::text('email', null, ['class' => 'form-control']) !!}
					</div>


					{!! Form::submit('Submit', ['class' => 'btn btn-info']) !!}

					{!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

