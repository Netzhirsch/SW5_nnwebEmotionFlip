<?php

namespace nnwebEmotionFlip;

use Shopware\Components\Plugin;
use Shopware\Components\Plugin\Context\ActivateContext;
use Shopware\Components\Plugin\Context\DeactivateContext;
use Shopware\Components\Plugin\Context\InstallContext;
use Shopware\Components\Plugin\Context\UpdateContext;
use Exception;
use Doctrine\Common\Collections\ArrayCollection;

class nnwebEmotionFlip extends Plugin {
	private $pluginname = 'nnwebEmotionFlip';

	public static function getSubscribedEvents() {
		return [
				'Enlight_Controller_Action_PostDispatchSecure_Widgets_Emotion' => 'extendsEmotionTemplates',
				'Enlight_Controller_Action_PostDispatchSecure_Backend_Emotion' => 'onPostDispatchBackendEmotion',
				'Theme_Compiler_Collect_Plugin_Less' => 'addLessFiles'
		];
	}

	public function activate(ActivateContext $context) {
		$context->scheduleClearCache(InstallContext::CACHE_LIST_ALL);
		parent::activate($context);
	}

	public function deactivate(DeactivateContext $context) {
		$context->scheduleClearCache(InstallContext::CACHE_LIST_ALL);
		parent::deactivate($context);
	}
	
	public function update(UpdateContext $context) {
		
		if (version_compare($context->getCurrentVersion(), "1.1.0", "<=")) {
			
			$emotionComponentInstaller = $this->container->get('shopware.emotion_component_installer');
			$element = $emotionComponentInstaller->createOrUpdate($this->getName(), "Flip-Banner", [
				'name' => 'Flip-Banner',
				'template' => 'component_nnweb_emotion_flip',
				'xtype' => 'emotion-components-nnweb-emotion-flip',
				'cls' => 'nnweb-emotion-flip'
			]);
			
			$element->createField([
				'name' => $this->pluginname . '_back_button_link_artikel',
				'fieldLabel' => 'Link auf Artikel',
				'xtype' => 'emotion-components-fields-article',
				'supportText' => 'Wird hier ein Artikel ausgewählt, wird der obige Link überschrieben.',
				'allowBlank' => true,
				'position' => '49'
			]);
			
		}
		
		$context->scheduleClearCache(InstallContext::CACHE_LIST_ALL);
		parent::update($context);
	}

	public function install(InstallContext $context) {
		parent::install($context);
		$this->registerEmotionElement();
	}

	private function registerEmotionElement() {
		$emotionComponentInstaller = $this->container->get('shopware.emotion_component_installer');
		
		$element = $emotionComponentInstaller->createOrUpdate($this->getName(), $this->pluginname, [
			'name' => 'Flip-Banner',
			'template' => 'component_nnweb_emotion_flip',
			'xtype' => 'emotion-components-nnweb-emotion-flip',
			'cls' => 'nnweb-emotion-flip'
		]);
		
		$element->createComboBoxField([
			'fieldLabel' => 'Flip-Richtung',
			'name' => $this->pluginname . '_flip_richtung',
			'supportText' => 'Sie können hier festlegen, aus welcher Richtung der Inhalt rotiert.',
			'allowBlank' => false,
			'store' => 'Shopware.apps.nnwebEmotionFlip.store.FlipDirection',
			'queryMode' => 'local',
			'displayField' => 'name',
			'valueField' => 'value',
			'defaultValue' => 'from_left'
		]);
		
		/*
		 * Front: Hintergrund
		 */
		$element->createDisplayField([
			'name' => 'front_hintergrund',
			'defaultValue' => 'Vorderseite: Hintergrund',
			'supportText' => '',
			'allowBlank' => true
		]);
		
		$element->createMediaField([
			'name' => $this->pluginname . '_front_hintergrund_bild',
			'fieldLabel' => 'Bild',
			'supportText' => 'Bitte wählen Sie ein Bild aus der Media-Verwaltung.',
			'allowBlank' => true,
			'translatable' => true
		]);
		
		$element->createComboBoxField([
			'fieldLabel' => 'Position',
			'name' => $this->pluginname . '_front_hintergrund_position',
			'supportText' => 'Sie können hier die Hintergrundposition festlegen.',
			'allowBlank' => false,
			'store' => 'Shopware.apps.nnwebEmotionFlip.store.HintergrundPositionStore',
			'queryMode' => 'local',
			'displayField' => 'name',
			'valueField' => 'value',
			'defaultValue' => 'center center'
		]);
		
		$element->createTextField([
			'name' => $this->pluginname . '_front_hintergrund_farbe',
			'fieldLabel' => 'Farbe',
			'defaultValue' => '#000000',
			'supportText' => 'Geben Sie einen Hintergrund an. Zum Beispiel #000000 für schwarz.',
			'allowBlank' => true,
			'helpTitle' => 'Weitere Möglichkeiten',
			'helpText' => 'Probieren sie auch Werte aus wie "purple", "linear-gradient(#909,#606)", "rgba(0,0,0,0.8)" oder "transparent".'
		]);
		
		/*
		 * Front: Headline
		 */
		$element->createDisplayField([
			'name' => 'front_headline',
			'defaultValue' => 'Vorderseite: Überschrift',
			'supportText' => '',
			'allowBlank' => true
		]);
		
		$element->createCheckboxField([
			'name' => $this->pluginname . '_front_ueberschrift_anzeigen',
			'fieldLabel' => 'Anzeigen'
		]);
		
		$element->createComboBoxField([
			'fieldLabel' => 'HTML-Tag',
			'name' => $this->pluginname . '_front_ueberschrift_tag',
			'supportText' => 'Sie können hier den HTML-Tag, der für die Überschrift genutzt wird, eingeben.',
			'allowBlank' => false,
			'store' => 'Shopware.apps.nnwebEmotionFlip.store.HeadlineTagStore',
			'queryMode' => 'local',
			'displayField' => 'name',
			'valueField' => 'value',
			'defaultValue' => 'h2'
		]);
		
		$element->createTextField([
			'name' => $this->pluginname . '_front_ueberschrift_text',
			'fieldLabel' => 'Text',
			'defaultValue' => 'Text',
			'supportText' => 'Sie können hier einen Text eingeben.',
			'allowBlank' => true,
			'translatable' => true
		]);
		
		$element->createComboBoxField([
			'fieldLabel' => 'Textausrichtung',
			'name' => $this->pluginname . '_front_ueberschrift_textalign',
			'supportText' => 'Sie können hier die Textausrichtung auswählen.',
			'allowBlank' => false,
			'store' => 'Shopware.apps.nnwebEmotionFlip.store.TextAlignStore',
			'queryMode' => 'local',
			'displayField' => 'name',
			'valueField' => 'value',
			'defaultValue' => 'center'
		]);
		
		$element->createTextField([
			'name' => $this->pluginname . '_front_ueberschrift_hintergrundfarbe',
			'fieldLabel' => 'Hintergrundfarbe',
			'defaultValue' => '#000000',
			'supportText' => 'Geben Sie einen Hintergrund an. Zum Beispiel #000000 für schwarz.',
			'allowBlank' => true,
			'helpTitle' => 'Weitere Möglichkeiten',
			'helpText' => 'Probieren sie auch Werte aus wie "purple", "linear-gradient(#909,#606)", "rgba(0,0,0,0.8)" oder "transparent".'
		]);
		
		$element->createTextField([
			'name' => $this->pluginname . '_front_ueberschrift_schriftfarbe',
			'fieldLabel' => 'Schriftfarbe',
			'defaultValue' => '#FFFFFF',
			'supportText' => 'Geben Sie eine Schriftfarbe im Hex-Format an an. Zum Beispiel #FFFFFF für weiß.',
			'allowBlank' => true
		]);
		
		$element->createTextField([
			'name' => $this->pluginname . '_front_ueberschrift_schriftgroesse',
			'fieldLabel' => 'Schriftgröße',
			'defaultValue' => '20px',
			'supportText' => 'Geben Sie eine Schriftgröße an. Zum Beispiel 20px oder 2vw.',
			'allowBlank' => true
		]);
		
		$element->createTextField([
			'name' => $this->pluginname . '_front_ueberschrift_cls',
			'fieldLabel' => 'CSS-Klassen',
			'defaultValue' => '',
			'supportText' => 'Mehrere Klassen können mit einem Leerzeichen getrennt hinzugefügt werden.',
			'allowBlank' => true
		]);
		
		/*
		 * Front: Text
		 */
		$element->createDisplayField([
			'name' => 'front_text',
			'defaultValue' => 'Vorderseite: Text',
			'supportText' => '',
			'allowBlank' => true
		]);
		
		$element->createCheckboxField([
			'name' => $this->pluginname . '_front_text_anzeigen',
			'fieldLabel' => 'Anzeigen'
		]);
		
		$element->createTextField([
			'name' => $this->pluginname . '_front_text_text',
			'fieldLabel' => 'Text',
			'defaultValue' => 'Text',
			'supportText' => 'Sie können hier einen Text eingeben.',
			'allowBlank' => true,
			'translatable' => true
		]);
		
		$element->createComboBoxField([
			'fieldLabel' => 'Textausrichtung',
			'name' => $this->pluginname . '_front_text_textalign',
			'supportText' => 'Sie können hier die Textausrichtung auswählen.',
			'allowBlank' => false,
			'store' => 'Shopware.apps.nnwebEmotionFlip.store.TextAlignStore',
			'queryMode' => 'local',
			'displayField' => 'name',
			'valueField' => 'value',
			'defaultValue' => 'center'
		]);
		
		$element->createTextField([
			'name' => $this->pluginname . '_front_text_hintergrundfarbe',
			'fieldLabel' => 'Hintergrundfarbe',
			'defaultValue' => '#000000',
			'supportText' => 'Geben Sie einen Hintergrund an. Zum Beispiel #000000 für schwarz.',
			'allowBlank' => true,
			'helpTitle' => 'Weitere Möglichkeiten',
			'helpText' => 'Probieren sie auch Werte aus wie "purple", "linear-gradient(#909,#606)", "rgba(0,0,0,0.8)" oder "transparent".'
		]);
		
		$element->createTextField([
			'name' => $this->pluginname . '_front_text_schriftfarbe',
			'fieldLabel' => 'Schriftfarbe',
			'defaultValue' => '#FFFFFF',
			'supportText' => 'Geben Sie eine Schriftfarbe im Hex-Format an an. Zum Beispiel #FFFFFF für weiß.',
			'allowBlank' => true
		]);
		
		$element->createTextField([
			'name' => $this->pluginname . '_front_text_schriftgroesse',
			'fieldLabel' => 'Schriftgröße',
			'defaultValue' => '12px',
			'supportText' => 'Geben Sie eine Schriftgröße an. Zum Beispiel 12px oder 2vw.',
			'allowBlank' => true
		]);
		
		$element->createTextField([
			'name' => $this->pluginname . '_front_text_cls',
			'fieldLabel' => 'CSS-Klassen',
			'defaultValue' => '',
			'supportText' => 'Mehrere Klassen können mit einem Leerzeichen getrennt hinzugefügt werden.',
			'allowBlank' => true
		]);
		
		/*
		 * Back: Hintergrund
		 */
		$element->createDisplayField([
			'name' => 'back_hintergrund',
			'defaultValue' => 'Hinterseite: Hintergrund',
			'supportText' => '',
			'allowBlank' => true
		]);
		
		$element->createMediaField([
			'name' => $this->pluginname . '_back_hintergrund_bild',
			'fieldLabel' => 'Bild',
			'supportText' => 'Bitte wählen Sie ein Bild aus der Media-Verwaltung.',
			'allowBlank' => true,
			'translatable' => true
		]);
		
		$element->createComboBoxField([
			'fieldLabel' => 'Position',
			'name' => $this->pluginname . '_back_hintergrund_position',
			'supportText' => 'Sie können hier die Hintergrundposition festlegen.',
			'allowBlank' => false,
			'store' => 'Shopware.apps.nnwebEmotionFlip.store.HintergrundPositionStore',
			'queryMode' => 'local',
			'displayField' => 'name',
			'valueField' => 'value',
			'defaultValue' => 'center center'
		]);
		
		$element->createTextField([
			'name' => $this->pluginname . '_back_hintergrund_farbe',
			'fieldLabel' => 'Farbe',
			'defaultValue' => '#000000',
			'supportText' => 'Geben Sie einen Hintergrund an. Zum Beispiel #000000 für schwarz.',
			'allowBlank' => true,
			'helpTitle' => 'Weitere Möglichkeiten',
			'helpText' => 'Probieren sie auch Werte aus wie "purple", "linear-gradient(#909,#606)", "rgba(0,0,0,0.8)" oder "transparent".'
		]);
		
		/*
		 * Back: Headline
		 */
		$element->createDisplayField([
			'name' => 'back_headline',
			'defaultValue' => 'Hinterseite: Überschrift',
			'supportText' => '',
			'allowBlank' => true
		]);
		
		$element->createCheckboxField([
			'name' => $this->pluginname . '_back_ueberschrift_anzeigen',
			'fieldLabel' => 'Anzeigen'
		]);
		
		$element->createComboBoxField([
			'fieldLabel' => 'HTML-Tag',
			'name' => $this->pluginname . '_back_ueberschrift_tag',
			'supportText' => 'Sie können hier den HTML-Tag, der für die Überschrift genutzt wird, eingeben.',
			'allowBlank' => false,
			'store' => 'Shopware.apps.nnwebEmotionFlip.store.HeadlineTagStore',
			'queryMode' => 'local',
			'displayField' => 'name',
			'valueField' => 'value',
			'defaultValue' => 'h2'
		]);
		
		$element->createTextField([
			'name' => $this->pluginname . '_back_ueberschrift_text',
			'fieldLabel' => 'Text',
			'defaultValue' => 'Text',
			'supportText' => 'Sie können hier einen Text eingeben.',
			'allowBlank' => true,
			'translatable' => true
		]);
		
		$element->createComboBoxField([
			'fieldLabel' => 'Textausrichtung',
			'name' => $this->pluginname . '_back_ueberschrift_textalign',
			'supportText' => 'Sie können hier die Textausrichtung auswählen.',
			'allowBlank' => false,
			'store' => 'Shopware.apps.nnwebEmotionFlip.store.TextAlignStore',
			'queryMode' => 'local',
			'displayField' => 'name',
			'valueField' => 'value',
			'defaultValue' => 'center'
		]);
		
		$element->createTextField([
			'name' => $this->pluginname . '_back_ueberschrift_hintergrundfarbe',
			'fieldLabel' => 'Hintergrundfarbe',
			'defaultValue' => '#000000',
			'supportText' => 'Geben Sie einen Hintergrund an. Zum Beispiel #000000 für schwarz.',
			'allowBlank' => true,
			'helpTitle' => 'Weitere Möglichkeiten',
			'helpText' => 'Probieren sie auch Werte aus wie "purple", "linear-gradient(#909,#606)", "rgba(0,0,0,0.8)" oder "transparent".'
		]);
		
		$element->createTextField([
			'name' => $this->pluginname . '_back_ueberschrift_schriftfarbe',
			'fieldLabel' => 'Schriftfarbe',
			'defaultValue' => '#FFFFFF',
			'supportText' => 'Geben Sie eine Schriftfarbe im Hex-Format an an. Zum Beispiel #FFFFFF für weiß.',
			'allowBlank' => true
		]);
		
		$element->createTextField([
			'name' => $this->pluginname . '_back_ueberschrift_schriftgroesse',
			'fieldLabel' => 'Schriftgröße',
			'defaultValue' => '20px',
			'supportText' => 'Geben Sie eine Schriftgröße an. Zum Beispiel 20px oder 2vw.',
			'allowBlank' => true
		]);
		
		$element->createTextField([
			'name' => $this->pluginname . '_back_ueberschrift_cls',
			'fieldLabel' => 'CSS-Klassen',
			'defaultValue' => '',
			'supportText' => 'Mehrere Klassen können mit einem Leerzeichen getrennt hinzugefügt werden.',
			'allowBlank' => true
		]);
		
		/*
		 * Back: Text
		 */
		$element->createDisplayField([
			'name' => 'back_text',
			'defaultValue' => 'Hinterseite: Text',
			'supportText' => '',
			'allowBlank' => true
		]);
		
		$element->createCheckboxField([
			'name' => $this->pluginname . '_back_text_anzeigen',
			'fieldLabel' => 'Anzeigen'
		]);
		
		$element->createTextField([
			'name' => $this->pluginname . '_back_text_text',
			'fieldLabel' => 'Text',
			'defaultValue' => 'Text',
			'supportText' => 'Sie können hier einen Text eingeben.',
			'allowBlank' => true,
			'translatable' => true
		]);
		
		$element->createComboBoxField([
			'fieldLabel' => 'Textausrichtung',
			'name' => $this->pluginname . '_back_text_textalign',
			'supportText' => 'Sie können hier die Textausrichtung auswählen.',
			'allowBlank' => false,
			'store' => 'Shopware.apps.nnwebEmotionFlip.store.TextAlignStore',
			'queryMode' => 'local',
			'displayField' => 'name',
			'valueField' => 'value',
			'defaultValue' => 'center'
		]);
		
		$element->createTextField([
			'name' => $this->pluginname . '_back_text_hintergrundfarbe',
			'fieldLabel' => 'Hintergrundfarbe',
			'defaultValue' => '#000000',
			'supportText' => 'Geben Sie einen Hintergrund an. Zum Beispiel #000000 für schwarz.',
			'allowBlank' => true,
			'helpTitle' => 'Weitere Möglichkeiten',
			'helpText' => 'Probieren sie auch Werte aus wie "purple", "linear-gradient(#909,#606)", "rgba(0,0,0,0.8)" oder "transparent".'
		]);
		
		$element->createTextField([
			'name' => $this->pluginname . '_back_text_schriftfarbe',
			'fieldLabel' => 'Schriftfarbe',
			'defaultValue' => '#FFFFFF',
			'supportText' => 'Geben Sie eine Schriftfarbe im Hex-Format an an. Zum Beispiel #FFFFFF für weiß.',
			'allowBlank' => true
		]);
		
		$element->createTextField([
			'name' => $this->pluginname . '_back_text_schriftgroesse',
			'fieldLabel' => 'Schriftgröße',
			'defaultValue' => '12px',
			'supportText' => 'Geben Sie eine Schriftgröße an. Zum Beispiel 12px oder 2vw.',
			'allowBlank' => true
		]);
		
		$element->createTextField([
			'name' => $this->pluginname . '_back_text_cls',
			'fieldLabel' => 'CSS-Klassen',
			'defaultValue' => '',
			'supportText' => 'Mehrere Klassen können mit einem Leerzeichen getrennt hinzugefügt werden.',
			'allowBlank' => true
		]);
		
		/*
		 * Back: Button
		 */
		$element->createDisplayField([
			'name' => 'back_button',
			'defaultValue' => 'Hinterseite: Button',
			'supportText' => '',
			'allowBlank' => true
		]);
		
		$element->createCheckboxField([
			'name' => $this->pluginname . '_back_button_anzeigen',
			'fieldLabel' => 'Anzeigen'
		]);
		
		$element->createTextField([
			'name' => $this->pluginname . '_back_button_text',
			'fieldLabel' => 'Text',
			'defaultValue' => 'Button',
			'supportText' => 'Sie können hier einen Text eingeben',
			'allowBlank' => true,
			'translatable' => true
		]);
		
		$element->createTextField([
			'name' => $this->pluginname . '_back_button_hintergrundfarbe',
			'fieldLabel' => 'Hintergrundfarbe',
			'defaultValue' => '#000000',
			'supportText' => 'Geben Sie einen Hintergrund an. Zum Beispiel #000000 für schwarz.',
			'allowBlank' => true,
			'helpTitle' => 'Weitere Möglichkeiten',
			'helpText' => 'Probieren sie auch Werte aus wie "purple", "linear-gradient(#909,#606)", "rgba(0,0,0,0.8)" oder "transparent".'
		]);
		
		$element->createTextField([
			'name' => $this->pluginname . '_back_button_schriftfarbe',
			'fieldLabel' => 'Schriftfarbe',
			'defaultValue' => '#FFFFFF',
			'supportText' => 'Geben Sie eine Schriftfarbe im Hex-Format an an. Zum Beispiel #FFFFFF für weiß.',
			'allowBlank' => true
		]);
		
		$element->createTextField([
			'name' => $this->pluginname . '_back_button_schriftgroesse',
			'fieldLabel' => 'Schriftgröße',
			'defaultValue' => '12px',
			'supportText' => 'Geben Sie eine Schriftgröße an. Zum Beispiel 20px oder 2vw.',
			'allowBlank' => true
		]);
		
		$element->createTextField([
			'name' => $this->pluginname . '_back_button_link',
			'fieldLabel' => 'Link',
			'defaultValue' => '',
			'supportText' => 'Sie können hier einen Hyperlink definieren.',
			'allowBlank' => true,
			'translatable' => true
		]);
		
		$element->createComboBoxField([
			'fieldLabel' => 'Link öffnen in',
			'name' => $this->pluginname . '_back_button_link_target',
			'supportText' => 'Sie können hier festlegen, wo der Link geöffnet wird.',
			'allowBlank' => false,
			'store' => 'Shopware.apps.nnwebEmotionFlip.store.LinkTargetStore',
			'queryMode' => 'local',
			'displayField' => 'name',
			'valueField' => 'value',
			'defaultValue' => '_self'
		]);
		
		$element->createField([
			'name' => $this->pluginname . '_back_button_link_artikel',
			'fieldLabel' => 'Link auf Artikel',
			'xtype' => 'emotion-components-fields-article',
			'supportText' => 'Wird hier ein Artikel ausgewählt, wird der obige Link überschrieben.',
			'allowBlank' => true
		]);
		
		$element->createTextField([
			'name' => $this->pluginname . '_back_button_cls',
			'fieldLabel' => 'CSS-Klassen',
			'defaultValue' => '',
			'supportText' => 'Mehrere Klassen können mit einem Leerzeichen getrennt hinzugefügt werden.',
			'allowBlank' => true
		]);
	}

	public function addLessFiles(\Enlight_Event_EventArgs $args) {
		$less = new \Shopware\Components\Theme\LessDefinition(array(),
				array(
						__DIR__ . '/Resources/views/frontend/_public/src/less/all.less'
				), __DIR__);
		
		return new ArrayCollection(array(
				$less
		));
	}

	public function extendsEmotionTemplates(\Enlight_Event_EventArgs $args) {
		$controller = $args->getSubject();
		$view = $controller->View();
		$view->addTemplateDir(__DIR__ . '/Resources/views/frontend/');
	}

	public function onPostDispatchBackendEmotion(\Enlight_Controller_ActionEventArgs $args) {
		$controller = $args->getSubject();
		$view = $controller->View();
		$view->addTemplateDir(__DIR__ . '/Resources/views/');
		$view->extendsTemplate(
				'backend/emotion/nnweb_emotion_flip/view/detail/elements/nnweb_emotion_flip.js');
		$view->extendsTemplate('backend/emotion/nnweb_emotion_flip/nnweb_emotion_flip_store.js');
	}
}