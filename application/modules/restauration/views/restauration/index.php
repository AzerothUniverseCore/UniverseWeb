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
              <li class="uk-nav-divider"></li>
              <?php if ($this->wowmodule->getVoteStatus() == '1'): ?>
              <li><a href="<?=site_url('vote');?>"><i class="fas fa-vote-yea"></i> <?=$this->lang->line('navbar_vote_panel');?></a></li>
              <?php endif;?>
            </ul>
          </div>
          <div class="uk-width-3-4@m">
            <h4 class="uk-h4 uk-text-uppercase uk-text-bold">Restauration de personnage</h4>
            <p class="uk-text-small">
              Tu as jou&eacute; sur Azeroth Universe avant le passage &agrave; une base de personnages propre, et tu veux r&eacute;cup&eacute;rer un de tes anciens personnages ?
              Connecte-toi ci-dessous avec l'identifiant et le mot de passe de ton <strong>ANCIEN</strong> compte de jeu (celui que tu utilisais &agrave; l'&eacute;poque, pas ton compte actuel) pour retrouver la liste de tes anciens personnages.
            </p>

            <?php if ($error): ?>
            <div class="uk-alert-danger" uk-alert>
              <p><?=htmlspecialchars($error);?></p>
            </div>
            <?php endif;?>

            <div class="uk-card uk-card-default uk-card-body">
              <?=form_open(site_url('restauration'));?>
                <div class="uk-margin">
                  <label class="uk-form-label" for="old_username">Identifiant de l'ANCIEN compte</label>
                  <div class="uk-form-controls">
                    <input class="uk-input" type="text" id="old_username" name="old_username" autocomplete="off" required>
                  </div>
                </div>
                <div class="uk-margin">
                  <label class="uk-form-label" for="old_password">Mot de passe de l'ANCIEN compte</label>
                  <div class="uk-form-controls">
                    <input class="uk-input" type="password" id="old_password" name="old_password" autocomplete="off" required>
                  </div>
                </div>
                <button type="submit" class="uk-button uk-button-default"><i class="fas fa-search"></i>&nbsp; Retrouver mes anciens personnages</button>
              <?=form_close();?>
            </div>

            <p class="uk-text-meta uk-margin-small-top">
              Ce mot de passe n'est utilis&eacute; que pour v&eacute;rifier que cet ancien compte t'appartient bien - il n'est ni stock&eacute; ni r&eacute;utilis&eacute; ailleurs.
              Un probl&egrave;me, un nom de personnage d&eacute;j&agrave; pris, ou un compte introuvable ? Passe par le Discord du serveur.
            </p>
          </div>
        </div>
      </div>
    </section>
