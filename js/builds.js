

window.uespd2UpdateAllWeaponPerks = function(updateFromHidden)
{
	uespd2UpdateAllWeaponPerksType("kinetic", updateFromHidden, UESPD2_KINETICWEAPON_DATA);
	uespd2UpdateAllWeaponPerksType("energy", updateFromHidden, UESPD2_ENERGYWEAPON_DATA);
	uespd2UpdateAllWeaponPerksType("power", updateFromHidden, UESPD2_POWERWEAPON_DATA);
	
	//_post_meta_weapons_group_0_kinetic_weapon_id_0
	//_post_meta_weapons_group_0_kinetic_weapon_perk1_id_0
	//_post_meta_weapons_group_0_kinetic_weapon_perk2_id_0
}


window.uespd2UpdateAllWeaponPerksType = function(weaponType, updateFromHidden, weaponData)
{
	var selectClass = '_post_meta_' + weaponType + '_weapons_group_' + weaponType + '_weapon_id';
	var elements = jQuery('select.' + selectClass);
	
	elements.each(function()
	{
		uespd2UpdateWeaponPerks(jQuery(this), weaponType, updateFromHidden, weaponData);
	});
}


window.uespd2UpdateWeaponPerks = function(element, weaponType, updateFromHidden, weaponData)
{
	var id = element.attr('id');
	var weaponId = parseInt(element.val());
	
	var matches = id.match(/_post_meta_([a-zA-Z]+)_weapons_group_0_([a-zA-Z]+)_weapon_id_([0-9]+)/);
	if (matches == null) return;
	
	var type = matches[1];
	var index = parseInt(matches[3]);
	if (isNaN(index) || index < 0) return;
	
	var perk1Id = '_post_meta_' + type + '_weapons_group_0_' + type + '_weapon_perk1_id_' + index;
	var perk2Id = '_post_meta_' + type + '_weapons_group_0_' + type + '_weapon_perk2_id_' + index;
	
	var perk1 = jQuery('#' + perk1Id);
	var perk2 = jQuery('#' + perk2Id);
	
	//console.log("Perk Elements", perk1, perk2);
	
	uespd2UpdateWeaponPerkOptions(weaponId, perk1, weaponData, updateFromHidden);
	uespd2UpdateWeaponPerkOptions(weaponId, perk2, weaponData, updateFromHidden);
}


var __uespd2_escapeEntityMap = {
	"&": "&amp;",
	"<": "&lt;",
	">": "&gt;",
	'"': '&quot;',
	"'": '&#39;',
	"/": '&#x2F;'
};

window.uespd2EscapeHtml = function(text) {
	return String(text).replace(/[&<>"'\/]/g, function (s) {
		return __uespd2_escapeEntityMap[s];
	});
}


window.uespd2SortSocketOptions = function(a, b)
{
	return a.name.localeCompare(b.name);
}


window.uespd2UpdateWeaponPerkOptions = function(weaponId, perkSelect, weaponData, updateFromHidden)
{
	var selectValue = perkSelect.val();
	var selectId = perkSelect.attr('id');
	var matches = selectId.match(/^(.*)([0-9]+)$/);
	var hiddenValue = jQuery('#' + matches[1] + 'hidden_' + matches[2]);
	
	if (updateFromHidden === true)
	{
		selectValue = hiddenValue.val();
	}
	
	perkSelect.find('option')
			.remove()
			.end()
			.append('<option value="">Select Perk</option>');
	
	if (isNaN(weaponId) || weaponId <= 0) return;
	
	var data = weaponData[weaponId];
	if (data == null) return;
	
	var optionData = [];
	
	for (var socketIndex in data.sockets)
	{
		var socket = data.sockets[socketIndex];
		
		var safeName = uespd2EscapeHtml(socket.name);
		var safeId = parseInt(socket.id);
		
		optionData.push({ name : safeName, id : safeId});
	}
	
	optionData.sort(uespd2SortSocketOptions);
	
	for (var i in optionData)
	{
		var data = optionData[i];
		perkSelect.append('<option value="' + data.id + '">' + data.name + '</option>');
	}
	
	perkSelect.val(selectValue);
	
	if (perkSelect.val() == null) 
	{
		perkSelect.val('');
		selectValue = '';
	}
	
	//_post_meta_kinetic_weapons_group_0_kinetic_weapon_perk1_id_0
	if (updateFromHidden !== true)
	{
		hiddenValue.val(selectValue);
	}
}


window.uespd2UpdateWeaponListPerks = function(e)
{
	var $this = jQuery(this);
	var id = $this.attr('id');
	
		// _post_meta_kinetic_weapons_group_kinetic_weapon_id 
	var matches = id.match(/_post_meta_([a-zA-Z]+)_weapons_group_0_([a-zA-Z]+)_weapon_id_([0-9]+)/);
	if (matches == null) return;
	
	var weaponData = null;
	var weaponType = matches[1];
	
	if (weaponType == 'kinetic') weaponData = UESPD2_KINETICWEAPON_DATA;
	else if (weaponType == 'energy') weaponData = UESPD2_ENERGYWEAPON_DATA;
	else if (weaponType == 'power') weaponData = UESPD2_POWERWEAPON_DATA;
	
	if (weaponData == null) return;
	
	uespd2UpdateWeaponPerks($this, weaponType, false, weaponData);
}


window.uespd2UpdateWeaponPerkFormValue = function(e)
{
	var $this = jQuery(this);
	var selectId = $this.attr('id');
	var matches = selectId.match(/^(.*)([0-9]+)$/);
	var hiddenValue = jQuery('#' + matches[1] + 'hidden_' + matches[2]);
	
	//var hiddenValue = $this.parent().next().find('input');
	
	hiddenValue.val($this.val());
	
	//console.log("Changed value to", $this.val(), hiddenValue);
}


jQuery(function() {
	//piklist-field-addmore-wrapper
	
	jQuery('._post_meta_kinetic_weapons_group_kinetic_weapon_id').on('change', uespd2UpdateWeaponListPerks );
	jQuery('._post_meta_energy_weapons_group_energy_weapon_id').on('change', uespd2UpdateWeaponListPerks );
	jQuery('._post_meta_power_weapons_group_power_weapon_id').on('change', uespd2UpdateWeaponListPerks );
	
	jQuery('._post_meta_kinetic_weapons_group_kinetic_weapon_perk1_id').on('change', uespd2UpdateWeaponPerkFormValue);
	jQuery('._post_meta_kinetic_weapons_group_kinetic_weapon_perk2_id').on('change', uespd2UpdateWeaponPerkFormValue);
	
	jQuery('._post_meta_energy_weapons_group_energy_weapon_perk1_id').on('change', uespd2UpdateWeaponPerkFormValue);
	jQuery('._post_meta_energy_weapons_group_energy_weapon_perk2_id').on('change', uespd2UpdateWeaponPerkFormValue);
	
	jQuery('._post_meta_power_weapons_group_power_weapon_perk1_id').on('change', uespd2UpdateWeaponPerkFormValue);
	jQuery('._post_meta_power_weapons_group_power_weapon_perk2_id').on('change', uespd2UpdateWeaponPerkFormValue);
	
	uespd2UpdateAllWeaponPerks(true);
});