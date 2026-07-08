<section class="uk-section uk-section-xsmall uk-padding-remove slider-section">
    <div class="uk-background-cover uk-height-small header-section"></div>
    <div class="syphrena-hero-divider-thin"></div>
</section>

<section class="uk-section uk-section-xsmall main-section" data-uk-height-viewport="expand: true">
    <div class="uk-container">
        <div class="uk-grid uk-grid-medium" data-uk-grid>
            <div class="uk-width-1-1">
                <div class="uk-width-auto">
                    <h4 class="uk-h4 uk-text-uppercase uk-text-bold"><i class="fas fa-download"></i> Installation</h4>
                    <div style="text-align: center;"><h4 class="uk-h4 uk-text-uppercase uk-text-bold"><i class="fas fa-chalkboard-teacher"></i> <u>Tutoriel</u></h4>
                        <a href="https://www.youtube.com/@AzerothUniverseTV" target="_blank" class="youtube-button">
                            <i class="fab fa-youtube"></i> Azeroth Universe TV
                        </a>
						<a href="https://youtu.be/L0ld-bKgGKk" target="_blank" class="youtube-button">
                            <i class="fab fa-youtube"></i> Installation Windows
                        </a>
						<a href="https://youtu.be/1C8nCnC6MWM" target="_blank" class="youtube-button">
                            <i class="fab fa-youtube"></i> Installation Mac
                        </a>
                </div>
                <div class="uk-width-expand@s">   
					<br>
                    
					</br>
                    <div class="uk-child-width-1-1" uk-grid>
                        <div>
                            <div uk-grid>
                                <div class="uk-width-auto@m">
                                    <ul class="uk-tab-left" uk-tab="connect: #component-tab-left; animation: uk-animation-slide-left-medium, uk-animation-slide-right-medium">
                                        <li><a href="#">Client</a></li>
                                    </ul>
                                </div>
                                <div class="uk-width-expand@m">
                                    <ul id="component-tab-left" class="uk-switcher">
										<li>
											<table class="uk-table uk-table-middle uk-table-divider">
												<thead>
													<tr>
														<th class="uk-width-small"></th>
														<th class="uk-width-medium"></th>
														<th></th>
														<th></th>
														<th></th>
													</tr>
												</thead>
												<tbody>
													<?php foreach ($this->download_model->getGame()->result() as $files): ?>
													<tr>
														<td><div style="background:url(<?=base_url('assets/images/forums/wow-icons/' . $files->image);?>); width: 50px; height: 50px;)"></div></td>
														<td><?=$files->fileName?></td>
														<td><?=$files->weight?></td>
														<td><?=$files->type?></td>
														<td><a class="uk-button uk-button-default" href="<?=$files->url?>" target="_blank"><i class="fas fa-download"></i> Télécharger</a></td>
													</tr>
													<?php endforeach;?>
												</tbody>
											</table>
										</li>
										<li>
											<table class="uk-table uk-table-middle uk-table-divider">
												<thead>
													<tr>
														<th class="uk-width-small"></th>
														<th class="uk-width-large"></th>
														<th></th>
														<th>Téléchargement</th>
													</tr>
												</thead>
												<tbody>
													<?php foreach ($this->download_model->getAddons()->result() as $files): ?>
													<tr>
														<td><div style="background:url(<?=base_url('assets/images/forums/wow-icons/' . $files->image);?>); width: 50px; height: 50px;)"></div></td>
														<td><?=$files->fileName?></td>
														<td><?=$files->weight?></td>
														<td><a class="uk-button uk-button-default" href="<?=$files->url?>" target="_blank"><i class="fas fa-download"></i> Téléchargement</a></td>
													</tr>
													<?php endforeach;?>
													<center><b></b></center>
												</tbody>
											</table>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<style>
    .youtube-button {
        display: inline-block;
        background-color: #FF0000;
        color: white;
        padding: 10px 20px;
        font-size: 16px;
        font-weight: bold;
        text-transform: uppercase;
        border-radius: 5px;
        text-decoration: none;
        transition: 0.3s;
    }

    .youtube-button i {
        margin-right: 8px;
    }

    .youtube-button:hover {
        background-color: #CC0000;
        transform: scale(1.05);
    }
</style>

<script type="text/javascript">
    
    window.addEventListener('contextmenu', function (e) {
        e.preventDefault();
    }, false);

    
    window.addEventListener('keydown', function (e) {
        if (e.keyCode === 123) { 
            e.preventDefault();
            alert("Les outils de développement sont désactivés.");
            return false;
        }
    }, false);

    
    window.addEventListener('keydown', function (e) {
        if ((e.ctrlKey && e.shiftKey && e.keyCode === 73) || 
            (e.ctrlKey && e.shiftKey && e.keyCode === 67) || 
            (e.ctrlKey && e.shiftKey && e.keyCode === 74) || 
            (e.ctrlKey && e.keyCode === 85)) { 
            e.preventDefault();
            alert("Les outils de développement sont désactivés.");
            return false;
        }
    }, false);
</script>