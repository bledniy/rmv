<div class="mb-5">
	@if(!empty($edit->video) AND is_array($edit->video))
		@foreach($edit->video as $link)
			<div class="row mt-3 clearfix" data-cloneable-row="">
				<div class="col-8 vertical-align-bottom">
					<input class="form-control" type="text" name="video[]" value="{{ $link }}" placeholder="@lang('modules._.tabs.video-youtube-link')">
				</div>
				<div class="col-2 vertical-align-bottom">
					@if ($link)
					<a href="{{$link}}" class="fancy" data-fancybox="cats_video">
						<img src="{{ getPreviewYoutubeFromLink($link) }}" alt="" class="img-fluid" width="85">
					</a>
					@endif
				</div>
				<div class="col-2 vertical-align-bottom">

					@include('admin.partials.action.key-value-buttons')
				</div>
			</div>
		@endforeach
	@else
		<div class="form-group row" data-cloneable-row="">
			<div class="col-10">
				<input class="form-control" type="text" name="video[]" placeholder="@lang('modules._.tabs.video-youtube-link')">
			</div>
			<div class="col-2">
				@include('admin.partials.action.key-value-buttons')
			</div>
		</div>
	@endif
</div>
