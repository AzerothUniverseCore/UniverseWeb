<?php
$myAccountId = $this->session->userdata('wow_sess_id');
$totalVoters = count($topVoters);
?>
<section class="uk-section uk-section-xsmall uk-padding-remove slider-section">
  <div class="uk-background-cover uk-height-small header-section"></div>
  <div class="syphrena-hero-divider-thin"></div>
</section>
<section class="uk-section uk-section-xsmall main-section topvote-page" data-uk-height-viewport="expand: true">
  <div class="uk-container">
    <div class="uk-grid uk-grid-medium" data-uk-grid>
      <div class="uk-width-1-4@m">
        <ul class="uk-nav uk-nav-default myaccount-nav">
          <?php if ($this->wowmodule->getUCPStatus() == '1'): ?>
          <li><a href="<?=site_url('panel');?>"><i class="fas fa-user-circle"></i> <?=$this->lang->line('tab_account');?></a></li>
          <?php endif;?>
          <li class="uk-nav-divider"></li>
          <?php if ($this->wowmodule->getDonationStatus() == '1'): ?>
          <li><a href="<?=site_url('donate');?>"><i class="fas fa-hand-holding-usd"></i> <?=$this->lang->line('navbar_donate_panel');?></a></li>
          <?php endif;?>
          <?php if ($this->wowmodule->getVoteStatus() == '1'): ?>
          <li><a href="<?=site_url('vote');?>"><i class="fas fa-vote-yea"></i> <?=$this->lang->line('navbar_vote_panel');?></a></li>
          <li class="uk-active"><a href="<?=site_url('topvote');?>"><i class="fas fa-crown"></i> <?=$this->lang->line('navbar_topvote_panel');?></a></li>
          <?php endif;?>
          <?php if ($this->wowmodule->getStoreStatus() == '1'): ?>
          <li><a href="<?=site_url('store');?>"><i class="fas fa-store"></i> <?=$this->lang->line('tab_store');?></a></li>
          <?php endif;?>
          <li class="uk-nav-divider"></li>
          <?php if ($this->wowmodule->getBugtrackerStatus() == '1'): ?>
          <li><a href="<?=site_url('bugtracker');?>"><i class="fas fa-bug"></i> <?=$this->lang->line('tab_bugtracker');?></a></li>
          <?php endif;?>
          <?php if ($this->wowmodule->getChangelogsStatus() == '1'): ?>
          <li><a href="<?=site_url('changelogs');?>"><i class="fas fa-scroll"></i> <?=$this->lang->line('tab_changelogs');?></a></li>
          <?php endif;?>
          <?php if ($this->wowmodule->getDownloadStatus() == '1'): ?>
          <li><a href="<?=site_url('download');?>"><i class="fas fa-download"></i> <?=$this->lang->line('tab_download');?></a></li>
          <?php endif;?>
        </ul>
      </div>
      <div class="uk-width-3-4@m">

        <div class="tv-titlebar">
          <h4 class="uk-h4 uk-text-uppercase uk-text-bold tv-title"><i class="fas fa-crown"></i> <?=$this->lang->line('tab_topvote');?></h4>
          <p class="tv-subtitle"><?=$this->lang->line('topvote_subtitle');?></p>
        </div>

        <div class="tv-stats-row">
          <div class="tv-stat-card">
            <i class="fas fa-users"></i>
            <div>
              <span class="tv-stat-value"><?=number_format($totalVoters, 0, ',', ' ');?></span>
              <span class="tv-stat-label"><?=$this->lang->line('topvote_stat_voters');?></span>
            </div>
          </div>
          <div class="tv-stat-card">
            <i class="fas fa-vote-yea"></i>
            <div>
              <span class="tv-stat-value"><?=number_format($globalVotes, 0, ',', ' ');?></span>
              <span class="tv-stat-label"><?=$this->lang->line('topvote_stat_total_votes');?></span>
            </div>
          </div>
          <div class="tv-stat-card">
            <i class="fas fa-gem"></i>
            <div>
              <span class="tv-stat-value"><?=number_format($globalPoints, 0, ',', ' ');?></span>
              <span class="tv-stat-label"><?=$this->lang->line('topvote_stat_vp_distributed');?></span>
            </div>
          </div>
        </div>

        <?php if ($totalVoters === 0): ?>

        <div class="tv-empty">
          <i class="fas fa-scroll"></i>
          <p><?=$this->lang->line('topvote_empty_text');?></p>
          <a href="<?=site_url('vote');?>" class="uk-button uk-button-default"><i class="fas fa-vote-yea"></i> <?=$this->lang->line('topvote_vote_now');?></a>
        </div>

        <?php else: ?>

        <?php if ($totalVoters >= 1): ?>
        <div class="tv-podium">
          <?php
            $podiumOrder = array(1 => 1, 0 => 0, 2 => 2); // 2e - 1er - 3e a l'affichage
            $podiumRanks = array('2nd' => 1, '1st' => 0, '3rd' => 2);
          ?>
          <?php foreach (array(1, 0, 2) as $idx): ?>
            <?php if (isset($topVoters[$idx])): $voter = $topVoters[$idx]; $rank = $idx + 1; ?>
            <div class="tv-podium-card tv-rank-<?=$rank;?> <?=($myAccountId == $voter->id ? 'tv-is-you' : '');?>">
              <div class="tv-podium-medal"><i class="fas <?=($rank == 1 ? 'fa-crown' : 'fa-medal');?>"></i></div>
              <div class="tv-podium-rank">#<?=$rank;?></div>
              <div class="tv-podium-name"><?=htmlspecialchars($voter->username);?></div>
              <div class="tv-podium-points"><?=number_format($voter->total_points, 0, ',', ' ');?> <span>VP</span></div>
              <div class="tv-podium-votes"><?=$voter->total_votes;?> <?=($voter->total_votes > 1 ? $this->lang->line('topvote_vote_plural') : $this->lang->line('topvote_vote_singular'));?></div>
            </div>
            <?php endif; ?>
          <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <div class="tv-list-wrap">
          <div class="tv-list-header">
            <span class="tv-col-rank">#</span>
            <span class="tv-col-name"><?=$this->lang->line('topvote_col_player');?></span>
            <span class="tv-col-votes"><?=$this->lang->line('topvote_col_votes');?></span>
            <span class="tv-col-points"><?=$this->lang->line('topvote_col_points');?></span>
            <span class="tv-col-last"><?=$this->lang->line('topvote_col_last_vote');?></span>
          </div>
          <div class="tv-list-scroll">
            <?php foreach ($topVoters as $key => $voter): $rank = $key + 1; ?>
            <div class="tv-row <?=($rank <= 3 ? 'tv-row-top tv-row-top-'.$rank : '');?> <?=($myAccountId == $voter->id ? 'tv-is-you' : '');?>">
              <span class="tv-col-rank">
                <?php if ($rank <= 3): ?>
                  <i class="fas fa-medal tv-medal-<?=$rank;?>"></i>
                <?php else: ?>
                  <?=$rank;?>
                <?php endif; ?>
              </span>
              <span class="tv-col-name">
                <?=htmlspecialchars($voter->username);?>
                <?php if ($myAccountId == $voter->id): ?><span class="tv-you-badge"><?=$this->lang->line('topvote_you_badge');?></span><?php endif; ?>
              </span>
              <span class="tv-col-votes" data-label="<?=$this->lang->line('topvote_col_votes');?> : "><?=$voter->total_votes;?></span>
              <span class="tv-col-points"><?=number_format($voter->total_points, 0, ',', ' ');?></span>
              <span class="tv-col-last"><?=date('d/m/Y', $voter->last_vote);?></span>
            </div>
            <?php endforeach; ?>
          </div>
        </div>

        <?php endif; ?>

      </div>
    </div>
  </div>
</section>

<style>
.topvote-page .tv-titlebar { margin-bottom: 18px; }
.topvote-page .tv-title { color: #f0c674; letter-spacing: 1px; text-shadow: 0 1px 2px rgba(0,0,0,.6); margin-bottom: 4px; }
.topvote-page .tv-title i { margin-right: 8px; }
.topvote-page .tv-subtitle { color: #b9ac93; font-size: 13px; margin-top: 0; max-width: 640px; }

.topvote-page .tv-stats-row {
  display: flex;
  gap: 14px;
  flex-wrap: wrap;
  margin-bottom: 26px;
}
.topvote-page .tv-stat-card {
  flex: 1 1 160px;
  display: flex;
  align-items: center;
  gap: 12px;
  padding: 14px 16px;
  background: linear-gradient(180deg, #2a2117, #1c150e);
  border: 1px solid #4a3a25;
  border-radius: 6px;
  box-shadow: inset 0 1px 0 rgba(255,255,255,.04);
}
.topvote-page .tv-stat-card i { font-size: 22px; color: #d9b26a; width: 26px; text-align: center; }
.topvote-page .tv-stat-value { display: block; font-size: 19px; font-weight: 700; color: #f3e2b8; line-height: 1.1; font-variant-numeric: tabular-nums; }
.topvote-page .tv-stat-label { display: block; font-size: 11px; text-transform: uppercase; letter-spacing: .6px; color: #9c8c6c; margin-top: 2px; }

.topvote-page .tv-empty {
  text-align: center;
  padding: 50px 20px;
  border: 1px dashed #4a3a25;
  border-radius: 8px;
  color: #b9ac93;
}
.topvote-page .tv-empty i { font-size: 30px; color: #6b5a3d; margin-bottom: 10px; display: block; }
.topvote-page .tv-empty p { margin-bottom: 16px; }

.topvote-page .tv-podium {
  display: grid;
  grid-template-columns: 1fr 1.15fr 1fr;
  align-items: end;
  gap: 12px;
  margin-bottom: 30px;
}
.topvote-page .tv-podium-card {
  position: relative;
  text-align: center;
  padding: 22px 12px 16px;
  border-radius: 8px;
  background: linear-gradient(180deg, #2c2317, #191309);
  border: 1px solid #4a3a25;
}
.topvote-page .tv-rank-1 { padding-top: 34px; border-color: #caa24c; box-shadow: 0 0 24px rgba(202,162,76,.25), inset 0 1px 0 rgba(255,255,255,.06); order: 2; transform: translateY(-10px); }
.topvote-page .tv-rank-2 { border-color: #9aa3ad; order: 1; }
.topvote-page .tv-rank-3 { border-color: #a9764f; order: 3; }
.topvote-page .tv-podium-medal { font-size: 26px; margin-bottom: 6px; }
.topvote-page .tv-rank-1 .tv-podium-medal { color: #f5cd6a; font-size: 32px; }
.topvote-page .tv-rank-2 .tv-podium-medal { color: #c3cbd2; }
.topvote-page .tv-rank-3 .tv-podium-medal { color: #cc9464; }
.topvote-page .tv-podium-rank { font-size: 11px; letter-spacing: 1px; color: #9c8c6c; text-transform: uppercase; margin-bottom: 4px; }
.topvote-page .tv-podium-name { font-weight: 700; color: #f3e2b8; font-size: 15px; margin-bottom: 8px; word-break: break-word; }
.topvote-page .tv-podium-points { font-size: 20px; font-weight: 700; color: #f5cd6a; font-variant-numeric: tabular-nums; }
.topvote-page .tv-podium-points span { font-size: 11px; color: #b9ac93; font-weight: 400; margin-left: 2px; }
.topvote-page .tv-podium-votes { font-size: 12px; color: #9c8c6c; margin-top: 4px; }
.topvote-page .tv-podium-card.tv-is-you { outline: 2px solid #6fbf73; outline-offset: 2px; }

.topvote-page .tv-list-wrap {
  border: 1px solid #4a3a25;
  border-radius: 8px;
  overflow: hidden;
  background: #1c150e;
}
.topvote-page .tv-list-header,
.topvote-page .tv-row {
  display: grid;
  grid-template-columns: 46px 1fr 90px 120px 110px;
  align-items: center;
  gap: 8px;
  padding: 10px 16px;
}
.topvote-page .tv-list-header {
  background: linear-gradient(180deg, #362a1a, #241a0f);
  color: #d9b26a;
  font-size: 11px;
  text-transform: uppercase;
  letter-spacing: .6px;
  border-bottom: 1px solid #4a3a25;
  position: sticky;
  top: 0;
}
.topvote-page .tv-list-scroll {
  max-height: 460px;
  overflow-y: auto;
  scrollbar-width: thin;
  scrollbar-color: #6b5a3d #1c150e;
}
.topvote-page .tv-list-scroll::-webkit-scrollbar { width: 8px; }
.topvote-page .tv-list-scroll::-webkit-scrollbar-track { background: #1c150e; }
.topvote-page .tv-list-scroll::-webkit-scrollbar-thumb { background: #6b5a3d; border-radius: 4px; }
.topvote-page .tv-row { border-bottom: 1px solid #2c2317; color: #d8cbb0; font-size: 13px; transition: background-color .15s ease; }
.topvote-page .tv-row:last-child { border-bottom: none; }
.topvote-page .tv-row:nth-child(even) { background: rgba(255,255,255,.015); }
.topvote-page .tv-row:hover { background: rgba(217,178,106,.08); }
.topvote-page .tv-row.tv-is-you { background: rgba(111,191,115,.12); }
.topvote-page .tv-col-rank { text-align: center; font-weight: 700; color: #9c8c6c; font-variant-numeric: tabular-nums; }
.topvote-page .tv-medal-1 { color: #f5cd6a; }
.topvote-page .tv-medal-2 { color: #c3cbd2; }
.topvote-page .tv-medal-3 { color: #cc9464; }
.topvote-page .tv-col-name { font-weight: 600; color: #f0e4c8; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
.topvote-page .tv-you-badge {
  display: inline-block;
  margin-left: 8px;
  padding: 1px 7px;
  font-size: 10px;
  border-radius: 10px;
  background: #6fbf73;
  color: #14260f;
  font-weight: 700;
  vertical-align: middle;
}
.topvote-page .tv-col-votes { text-align: center; font-variant-numeric: tabular-nums; color: #b9ac93; }
.topvote-page .tv-col-points { text-align: right; font-weight: 700; color: #f5cd6a; font-variant-numeric: tabular-nums; }
.topvote-page .tv-col-last { text-align: right; color: #8a7c60; font-size: 12px; }

@media (max-width: 639px) {
  .topvote-page .tv-podium { grid-template-columns: 1fr; }
  .topvote-page .tv-rank-1, .topvote-page .tv-rank-2, .topvote-page .tv-rank-3 { order: initial; transform: none; }
  .topvote-page .tv-list-header { display: none; }
  .topvote-page .tv-row { grid-template-columns: 32px 1fr auto; grid-template-areas: "rank name points" "rank votes last"; row-gap: 2px; }
  .topvote-page .tv-col-rank { grid-area: rank; }
  .topvote-page .tv-col-name { grid-area: name; white-space: normal; }
  .topvote-page .tv-col-points { grid-area: points; }
  .topvote-page .tv-col-votes { grid-area: votes; text-align: left; }
  .topvote-page .tv-col-votes::before { content: attr(data-label); color: #6b5a3d; }
  .topvote-page .tv-col-last { grid-area: last; text-align: left; }
}
</style>
