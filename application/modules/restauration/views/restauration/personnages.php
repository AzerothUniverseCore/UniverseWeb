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
            <h4 class="uk-h4 uk-text-uppercase uk-text-bold">Tes anciens personnages</h4>

            <?php if (empty($characters)): ?>
            <div class="uk-alert-warning" uk-alert>
              <p>Aucun personnage (non supprim&eacute;) n'a &eacute;t&eacute; trouv&eacute; sur cet ancien compte.</p>
            </div>
            <?php else: ?>
            <p class="uk-text-small">
              Choisis le personnage &agrave; restaurer sur ton compte actuel. Cette action est d&eacute;finitive et ne peut &ecirc;tre faite qu'une seule fois par personnage.
              Les objets, sorts, talents, familiers, quetes, hauts faits et r&eacute;putations sont restaur&eacute;s. La guilde, le groupe, l'&eacute;quipe d'ar&egrave;ne, le courrier et l'h&ocirc;tel des ventes ne le sont pas.
            </p>
            <table class="uk-table uk-table-divider uk-table-middle">
              <thead>
                <tr>
                  <th>Nom</th>
                  <th>Niveau</th>
                  <th>Race / Classe (ID)</th>
                  <th>Or</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($characters as $c): ?>
                <tr>
                  <td><strong><?=htmlspecialchars($c['name']);?></strong></td>
                  <td><?=(int) $c['level'];?></td>
                  <td>#<?=(int) $c['race'];?> / #<?=(int) $c['class'];?></td>
                  <td><?=number_format(((int) $c['money']) / 10000, 0, ',', ' ');?> po</td>
                  <td class="uk-text-right">
                    <?php if ($c['already_restored']): ?>
                      <span class="uk-label">D&eacute;j&agrave; restaur&eacute;</span>
                    <?php else: ?>
                      <?=form_open(site_url('restauration/restaurer/' . (int) $c['guid']));?>
                        <button type="submit" class="uk-button uk-button-primary uk-button-small"
                                onclick="return confirm('Restaurer ' + <?=json_encode($c['name']);?> + ' sur ton compte actuel ? Cette action est definitive.');">
                          <i class="fas fa-undo"></i>&nbsp; Restaurer
                        </button>
                      <?=form_close();?>
                    <?php endif;?>
                  </td>
                </tr>
                <?php endforeach;?>
              </tbody>
            </table>
            <?php endif;?>
          </div>
        </div>
      </div>
    </section>
