{!! Form::open(array('route' => 'route.name', 'method' => 'POST')) !!}
	<ul>
		<li>
			{!! Form::label('Name', 'Name:') !!}
			{!! Form::text('Name') !!}
		</li>
		<li>
			{!! Form::label('Notes', 'Notes:') !!}
			{!! Form::text('Notes') !!}
		</li>
		<li>
			{!! Form::label('Grade_id', 'Grade_id:') !!}
			{!! Form::text('Grade_id') !!}
		</li>
		<li>
			{!! Form::submit() !!}
		</li>
	</ul>
{!! Form::close() !!}