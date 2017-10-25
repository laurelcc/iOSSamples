<?php
add_action('admin_footer','maha_shortcodes_form');
function maha_shortcodes_form(){
    ?>
    <div class="sm-wrapper">

    	<!-- START UI -->
	    <div id="ui-shortcodes-maha" class="mfp-hide mfp-with-anim ui-maha">

					<!-- START NAV TYPE -->
					<div class="nav-type">
						<ul>
							<li class="group"><?php echo('Column'); ?></li>
							<li class="item mps-column active"><?php echo('Row & Column'); ?></li>

							<li class="group"><?php echo('Elements'); ?></li>
							<li class="item mps-button"><?php echo('Button'); ?></li>
							<li class="item mps-divider"><?php echo('Divider'); ?></li>
							<li class="item mps-dropcap"><?php echo('Dropcap'); ?></li>
							<li class="item mps-highlight"><?php echo('Highlight'); ?></li>
							<li class="item mps-message-box"><?php echo('Message Box'); ?></li>
							<li class="item mps-tabs"><?php echo('Tabs'); ?></li>
							<li class="item mps-toggle"><?php echo('Toggle'); ?></li>
							<li class="item mps-video"><?php echo('Video'); ?></li>
							<li class="item mps-full"><?php echo('Content Full Width'); ?></li>
							<li class="item mps-maps"><?php echo('Google Maps'); ?></li>
						</ul>
					</div>

					<!-- START NAV FORM -->
					<div class="nav-form">

						<div class="nav-clearer"><button id="clearer" type="button" value="<?php echo("Clear all fields"); ?>" class="button"><?php echo("Clear all fields"); ?></button></div>
						<div class="nav-form-title">Row & Column</div>

				<!-- Row & Column -->
						<div class="form-item mps-column active">

							<div class="form-group">

								<div class="field-item">
									<div class="form-title">Reverse :</div>
									<div class="form-content">
										<input type="checkbox" class="reverse"/>
									</div>
								</div>

								<div class="field-item">
									<div class="row">
										<div class='column cl-6'></div>
										<div class='column cl-6'></div>
									</div>
									<div class="row">
										<div class='column cl-4'></div>
										<div class='column cl-4'></div>
										<div class='column cl-4'></div>
									</div>
									<div class="row">
										<div class='column cl-3'></div>
										<div class='column cl-3'></div>
										<div class='column cl-3'></div>
										<div class='column cl-3'></div>
									</div>
									<div class="row reverse">
										<div class='column cl-4'></div>
										<div class='column cl-8'></div>
									</div>
									<div class="row reverse">
										<div class='column cl-3'></div>
										<div class='column cl-9'></div>
									</div>
								</div>

							</div>
						</div>

				<!-- Button -->
						<div class="form-item mps-button">

							<div class="form-group">

								<div class="field-item">
									<div class="form-title">Button Size:</div>
									<div class="form-content">
								    	<input name="button-size" id="button-size-small" type="radio" name="button-size" value="small">
										<label for="button-size-small">Small</label>
									    <input name="button-size" id="button-size-medium" type="radio" name="button-size" value="medium" checked="checked">
										<label for="button-size-medium">Medium</label>
									    <input name="button-size" id="button-size-large" type="radio" name="button-size" value="large">
										<label for="button-size-large">Large</label>
									</div>
								</div>

								<div class="field-item">
									<div class="form-title">Link URL:</div>
									<div class="form-content">
										<input type="text" class="link-url">
									</div>
								</div>

								<div class="field-item">
									<div class="form-title">Button Text :</div>
									<div class="form-content">
										<input type="text" class="button-text">
									</div>
								</div>

								<div class="field-item">
									<div class="form-title">Open in new tab:</div>
									<div class="form-content">
										<input type="checkbox" class="blank">
									</div>
								</div>

								<div class="field-item">
									<div class="form-title">Color Scheme:</div>
									<div class="form-content">
										<input name="button-color" id="button-alt-1" type="radio" value="alt-1" checked="checked">
										<label for="button-alt-1" class="accent-1">Accent Color 1</label>
										<input name="button-color" id="button-alt-2" type="radio" value="alt-2" checked="checked">
										<label for="button-alt-2" class="accent-2">Accent Color 2</label>
										<br><br>
									    <input name="button-color" id="button-dark" type="radio" value="dark" checked="checked">
										<label for="button-dark" class="color-scheme dark"> </label>
									    <input name="button-color" id="button-red" type="radio" value="red">
										<label for="button-red" class="color-scheme red"> </label>
									    <input name="button-color" id="button-blue" type="radio" value="blue">
										<label for="button-blue" class="color-scheme blue"> </label>
									    <input name="button-color" id="button-green" type="radio" value="green">
									  	<label for="button-green" class="color-scheme green"> </label>
									  	<input name="button-color" id="button-orange" type="radio" value="orange">
									 	<label for="button-orange" class="color-scheme orange"> </label>
									    <input name="button-color" id="button-green-tosca" type="radio" value="green-tosca">
									  <label for="button-green-tosca" class="color-scheme tosca"> </label>
									</div>
								</div>

							</div>
						</div>

				<!-- Tabbed -->
						<div class="form-item mps-tabs">

							<div class="form-group">
								<div class="field-item">
									<div class="form-title">Tab Position</div>
									<div class="form-content">
										<input name="tab-position" id="tab-horizontal" type="radio" value="horizontal" checked="checked">
										<label for="tab-horizontal">Horizontal</label>
										<input name="tab-position" id="tab-vertical" type="radio" value="vertical">
										<label for="tab-vertical">Vertical</label>
									</div>
								</div>
							</div>

							<div class="mps-wrap">								
								<div class="form-group">									

									<div class="field-item">
										<div class="form-title">Tab Title:</div>
										<div class="form-content">
											<input type="text" class="tab-title">
										</div>
									</div>

									<div class="field-item">
										<div class="form-title">Tab Content:</div>
										<div class="form-content">
											<textarea class="tab-content"></textarea>
										</div>
									</div>

								</div>

							</div>

							<div class="group-control">
								<button type="button" value="<?php echo("Remove Tab"); ?>" class="button remove-group"><?php echo("Remove Tab"); ?></button>
								<button type="button" value="<?php echo("Add Tab"); ?>" class="button add-group"><?php echo("Add Tab"); ?></button>
							</div>
						</div>

				<!-- Toggle -->
						<div class="form-item mps-toggle">

							<div class="form-group">

								<div class="field-item">
									<div class="form-title">Turn into Accordion:</div>
									<div class="form-content">
										<input type="checkbox" class="accordion">
									</div>
								</div>

							</div>

							<div class="mps-wrap">
								<div class="form-group">									

									<div class="field-item">
										<div class="form-title">Tab Title:</div>
										<div class="form-content">
											<input type="text" class="tab-title">
										</div>
									</div>

									<div class="field-item">
										<div class="form-title">Tab Content:</div>
										<div class="form-content">
											<textarea class="tab-content"></textarea>
										</div>
									</div>

								</div>

							</div>

							<div class="group-control">
								<button type="button" value="<?php echo("Remove Toggle"); ?>" class="button remove-group"><?php echo("Remove Toggle"); ?></button>
								<button type="button" value="<?php echo("Add Toggle"); ?>" class="button add-group"><?php echo("Add Toggle"); ?></button>
							</div>
						</div>

				<!-- Dropcap -->
						<div class="form-item mps-dropcap">

							<div class="form-group">

								<div class="field-item">
									<div class="form-title">Dropcap Style:</div>
									<div class="form-content">
									    <input name="dropcap-style" id="dropcap-square" type="radio" value="square" checked="checked">
										<label for="dropcap-square">Square</label>
									    <input name="dropcap-style" id="dropcap-circle" type="radio" value="circle">
										<label for="dropcap-circle">Circle</label>
									    <input name="dropcap-style" id="dropcap-normal" type="radio" value="normal">
									  <label for="dropcap-normal">Normal</label>
									</div>
								</div>

								<div class="field-item">
									<div class="form-title">Dropcap Title:</div>
									<div class="form-content">
										<input type="text" class="dropcap-title">
									</div>
								</div>								

								<div class="field-item shortcode-preview">
									<div class="form-title">Example:</div>
									<div class="form-content"> [dropcap ='Your text here']
									</div>
								</div>

							</div>
						</div>

				<!-- Highlight -->
						<div class="form-item mps-highlight">

							<div class="form-group">

								<div class="field-item">
									<div class="form-title">Highlight Text:</div>
									<div class="form-content">
										<textarea class="highlight-text"></textarea>
									</div>
								</div>

								<div class="field-item">
									<div class="form-title">Color Scheme:</div>
									<div class="form-content">
									    <input name="highlight-color" id="highlight-red" type="radio" value="red" checked="checked">
										<label for="highlight-red" class="color-highlight red"> </label>
									    <input name="highlight-color" id="highlight-blue" type="radio" value="blue">
										<label for="highlight-blue" class="color-highlight blue"> </label>
									    <input name="highlight-color" id="highlight-green" type="radio" value="green">
									  	<label for="highlight-green" class="color-highlight green"> </label>
									  	<input name="highlight-color" id="highlight-orange" type="radio" value="orange">
									 	<label for="highlight-orange" class="color-highlight orange"> </label>
									    <input name="highlight-color" id="highlight-yellow" type="radio" value="yellow">
									  	<label for="highlight-yellow" class="color-highlight yellow"> </label>
									</div>
								</div>

								<div class="field-item shortcode-preview">
									<div class="form-title">Example:</div>
									<div class="form-content"> [highlight ='Your text here']
									</div>
								</div>

							</div>
						</div>

				<!-- Message Box -->
						<div class="form-item mps-message-box">

							<div class="form-group">

								<div class="field-item">
									<div class="form-title">Message Title:</div>
									<div class="form-content">
										<input type="text" class="message-title">
									</div>
								</div>

								<div class="field-item">
									<div class="form-title">Message Text:</div>
									<div class="form-content">
										<textarea class="message-box"></textarea>
									</div>
								</div>

								<div class="field-item shortcode-preview">
									<div class="form-title">Example:</div>
									<div class="form-content"> [message_box ='Your text here']
									</div>
								</div>

							</div>
						</div>

				<!-- Divider -->
						<div class="form-item mps-divider">

							<div class="form-group">

								<div class="field-item">
									<div class="form-title">Divider Style:</div>
									<div class="form-content">
									    <input name="divider-style" id="divider-thin" type="radio" value="thin" checked="checked">
										<label for="divider-thin">Thin (1px)</label>
									    <input name="divider-style" id="divider-bold" type="radio" value="bold">
										<label for="divider-bold">Bold (4px)</label>
									</div>
								</div>

								<div class="field-item">
									<div class="form-title">Divider Title:</div>
									<div class="form-content">
										<input type="text" class="divider-title">
									</div>
								</div>

								<div class="field-item">
									<div class="form-title">Divider Title Align:</div>
									<div class="form-content">
										<select class="divider-align">
											<option value="">Text Left</option>
											<option value="text-center">Text Center</option>
											<option value="text-right">Text Right</option>
										</select>
									</div>
								</div>

							</div>
						</div>

				<!-- Video -->
						<div class="form-item mps-video">

							<div class="form-group">

								<div class="field-item">
									<div class="form-title">Video Type:</div>
									<div class="form-content">
									    <input name="video-type" id="video-youtube" type="radio" value="youtube" checked="checked">
										<label for="video-youtube">Youtube</label>
									    <input name="video-type" id="video-vimeo" type="radio" value="vimeo">
										<label for="video-vimeo">Vimeo</label>
										<input name="video-type" id="video-dailymotion" type="radio" value="dailymotion">
										<label for="video-dailymotion">Dailymotion</label>
									</div>
								</div>

								<div class="field-item">
									<div class="form-title">Video Url</div>
									<div class="form-content">
										<input type="text" class="video-url">
									</div>
								</div>
								<div class="field-item">
									<div class="form-title">Turn on video title:</div>
									<div class="form-content">
										<input type="checkbox" class="vidtitle" checked>
									</div>
								</div>
								<div class="field-item">
									<div class="form-title">Turn on video playbar:</div>
									<div class="form-content">
										<input type="checkbox" class="vidplaybar" checked>
									</div>
								</div>

							</div>
						</div>

					<!-- Content Full Width -->
						<div class="form-item mps-full">

							<div class="form-group">

								<div class="field-item">
									<div class="form-title">Content:</div>
									<div class="form-content">
										<textarea class="content-box"></textarea>
									</div>
								</div>

							</div>
						</div>

					<!-- Google Maps -->
						<div class="form-item mps-maps">

							<div class="form-group">

								<div class="field-item">
									<div class="form-title">Map Point:</div>
									<div class="form-content">
										<input type="text" class="maps-point" value="48.218993, 11.624598">
									</div>
								</div>

								<div class="field-item">
									<div class="form-title">Width (px):</div>
									<div class="form-content">
										<input type="text" class="maps-width" value="500">
									</div>
								</div>

								<div class="field-item">
									<div class="form-title">Height (px):</div>
									<div class="form-content">
										<input type="text" class="maps-height" value="500">
									</div>
								</div>

								<div class="field-item">
									<div class="form-title">Map Zoom:</div>
									<div class="form-content">
										<input type="text" class="maps-zoom" value="10">
									</div>
								</div>

							</div>
						</div>

						<!-- FORM SUBMIT -->
						<div class="form-submit">
							<button id="close_ui" type="button" value="<?php echo("Cancel"); ?>" class="button"><?php echo("Cancel"); ?></button>
							<button id="insert_shortcode" value="<?php echo("Insert"); ?>" class="button button-primary" type="button"><?php echo("Insert"); ?></button>
						</div>

					</div>
					<!-- END NAV FORM -->

				</div>
				<!-- END UI -->

		</div>

		<script type="text/javascript">
			jQuery(document).ready(function($){
				$(window).gms_handler();
			});
		</script>
    <?php
}
?>