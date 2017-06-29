<?php
/*
  Class for the options page of the plugin.
*/
class options_page {
  private $accounts = [
    'facebook',
    'twitter',
    'google'
  ];
  private $options = [];

  public function __construct () {
    add_action('admin_init', [$this, 'page_init']);
    add_action('admin_menu', [$this, 'create_admin_page']);
  }

  public function create_admin_page () {
    add_options_page(
      'Social account options', // Page title.
      'Social accounts', // Name for the menu.
      'administrator', // Capability for the user.
      'settings_social_accounts', // The slug for the page.
      [$this, 'create_content_page'] // The function that return the content of the page.
    );
  }

  public function create_content_page () {
    foreach ($this->accounts as $key => $account) {
      $option_name = $account .'_account';
      $this->options[$option_name] = get_option($option_name);
    }
    ?>
      <div class="wrap">
        <form action="options.php" method="post">
          <?php settings_fields('option_group'); ?>
          <?php do_settings_sections('settings_social_accounts'); ?>
          <?php submit_button(); ?>
        </form>
      </div>
    <?php
  }

  public function page_init () {
    // Register the option setting.
    foreach ($this->accounts as $key => $account) {
      register_setting('option_group', $account. '_account');
    }

    // Add section for the page.
    add_settings_section(
      'social_accounts', // Id section.
      'Social account settings', // Title page.
      [$this, 'create_page_info'], // Callback.
      'settings_social_accounts' // Name of the option page SLUG.
    );

    foreach ($this->accounts as $key => $account) {
      $label = ucfirst($account) .' account';
      $function = 'create_'. $account .'_input';
      $account .= '_account';
      
      $this->$function = function ($account) {
        ?>
          <input type="text"
                id="<?= $account ?>"
                name="<?= $account ?>"
                value="<?= $this->options[$account] ?>"
          />
        <?php
      };
      add_settings_field(
        $account,
        $label,
        [$this, $function],
        'settings_social_accounts',
        'social_accounts',
        $account
      );
    }
  }

  public function create_page_info () {
    ?>
      <h1>Set the social accounts</h1>
    <?php
  }

  public function __call ($closure, $args) {
      call_user_func_array($this->$closure, $args);
  }
}
?>