<?php

if ( '' !== $message ) { ?>
	<div class="panel">
		<div class="panel-heading"><?php echo esc_attr( $message ); ?></div>    
	</div>
<?php } ?>
	<h1>Terms of Use Modal And Cookie Settings</h1>
	<div class="wrap">    
	<form name="form" action="" method="post">
		<?php settings_fields( 'crm-settings-group' ); ?>
		<?php do_settings_sections( 'crm-settings-group' ); ?>
		<table class="form-table">
			<tbody>
				<tr>
					<th><label>Cookie Expiration Date</label></th>
					<td><input type="text" name="cookie_expiration_date" value="<?php echo esc_attr( get_option( 'cookie_expiration_date' ,'2023-01-15') ); ?>"/></td>
				</tr>
				<tr>
					<th><label>Cookie Domain</label></th>
					<td><input type="text" name="cookie_domain" value="<?php echo esc_attr( get_option( 'cookie_domain' ) ); ?>"/></td>
				</tr>
				<tr>
					<th><label>Updated Term Effective Date (appears in model)</label></th>
					<td><input type="text" name="effective_date" value="<?php echo esc_attr( get_option( 'effective_date','January 1, 2023' ) ); ?>"/></td>
				</tr>
				<tr>
					<th><label>Link Url (appears in model)</label></th>
					<td><input type="text" name="link_url" value="<?php echo esc_attr( get_option( 'link_url','https://www.iccsafe.org/about/terms-of-use/' ) ); ?>"/></td>
				</tr>

				<tr>
					<td colspan="2">
						<input type="submit" name="terms_setting_save" id="submit" class="button button-primary" value="Save Changes">
					</td>
				</tr>
			</tbody>
		</table>
	</form>
</div>

