<?php
function social_accounts ($atts) {
  $accounts = [
    'facebook' => get_option('facebook_account'),
    'twitter' => get_option('twitter_account'),
    'google' => get_option('google_account')
  ];
  $atts = shortcode_atts($accounts, $atts);
  $html = '<div class="social-accounts">';
  $html .= '<ul>';

  foreach ($atts as $accountKey => $account) {
    $html .= "<li><a href='http://$accountKey.com/$account'>$accountKey</a></li>";
  }
  
  $html .= '</ul>';
  $html .= '</div>';

  return $html;
}
?>