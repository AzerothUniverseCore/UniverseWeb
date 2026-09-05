    <section class="uk-section uk-section-xsmall uk-padding-remove slider-section">
      <div class="uk-background-cover uk-height-small header-section"></div>
      <div class="syphrena-hero-divider-thin"></div>
    </section>
    <section class="uk-section uk-section-xsmall main-section" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-medium" data-uk-grid>
          <div class="uk-width-1-4@m">
            <ul class="uk-nav uk-nav-default myaccount-nav">
              <?php if ($this->wowmodule->getUCPStatus() == '1'): ?>
              <li><a href="<?=site_url('panel');?>"><i class="fas fa-user-circle"></i> <?=$this->lang->line('tab_account');?></a></li>
              <?php endif;?>
              <li class="uk-active"><a href="<?=site_url('restauration');?>"><i class="fas fa-history"></i> Restauration de personnage</a></li>
            </ul>
          </div>
          <div class="uk-width-3-4@m">
            <h4 class="uk-h4 uk-text-uppercase uk-text-bold">Restauration de personnage</h4>

            <?php if ($result['success']): ?>
            <div class="uk-alert-success" uk-alert>
              <p><i class="fas fa-check-circle"></i>&nbsp; <strong><?=htmlspecialchars($result['name']);?></strong> a bien &eacute;t&eacute; restaur&eacute; sur ton compte actuel ! Tu peux le retrouver en jeu au prochain lancement du client.</p>
            </div>
            <?php else: ?>
            <div class="uk-alert-danger" uk-alert>
              <p><i class="fas fa-times-circle"></i>&nbsp; <?=htmlspecialchars($result['message']);?></p>
            </div>
            <?php endif;?>

            <a href="<?=site_url('restauration/personnages');?>" class="uk-button uk-button-default"><i class="fas fa-arrow-left"></i>&nbsp; Retour &agrave; la liste</a>
          </div>
        </div>
      </div>
    </section>
