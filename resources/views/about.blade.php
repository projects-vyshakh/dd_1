@section('head')
@stop
@extends('layouts.master')
@section('main')
<div class="main-content">
	<div class="container">

		<div class="row">
			<div class="col-md-12">
				<!-- start: FORM VALIDATION 1 PANEL -->

				<div class="user-profile" style="margin-top:20px; ">
					<div class="row">
						<div class="col-md-12">
							<div class="content">
								<div class="title">
									<h2>{{ trans('lang.about') }}</h2>
								</div>
									<hr>
									<p align="center">No data found</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@stop