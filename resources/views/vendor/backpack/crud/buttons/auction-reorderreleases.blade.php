@if ($crud->hasAccess('update'))
<a href="auction/reorder/new_release" class="btn btn-outline-primary" data-style="zoom-in">
	<span class="ladda-label">
		<i class="la la-arrows"></i> {{  __('Reorder New Releases') }}
	</span>
</a>
@endif
