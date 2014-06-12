

    <?php
				if ($form) :
					?>
<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
	<h2>Create Note</h2>
	<hr>
		<?php echo $form; ?>
	</div>

				<?php
	endif;
				?>

<div id="DiaryDialog" class="modal fade bs-example-modal-sm"
	tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
	aria-hidden="true" style="display: none;">
	<div class="modal-dialog modal-md">
		<div class="modal-content">

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"
					aria-hidden="true">×</button>
				<h4 class="modal-title">Small modal</h4>
			</div>
			<div class="modal-body">...</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

			</div>
		</div>
		<!-- /.modal-content -->

	</div>
	<!-- /.modal-dialog -->
</div>
<!-- Hack Fix for CKEditor submitting Blank Content -->
