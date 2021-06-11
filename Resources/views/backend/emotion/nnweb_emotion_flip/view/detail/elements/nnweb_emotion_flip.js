//
//{block name="backend/emotion/view/detail/elements/base"}
//{$smarty.block.parent}
Ext.define('Shopware.apps.Emotion.view.detail.elements.nnwebEmotionFlip', {

    extend: 'Shopware.apps.Emotion.view.detail.elements.Base',

    alias: 'widget.detail-element-emotion-components-nnweb-emotion-flip',

    componentCls: 'emotion--nnweb-emotion-flip',

    icon: '  data:image/png;base64,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',

    createPreview: function() {
        var me = this,
            preview = '',
            image = me.getConfigValue('nnwebEmotionFlip_front_hintergrund_bild'),
            position = 'center center',
            style;

        if (Ext.isDefined(image)) {
            style = Ext.String.format('background-image: url([0]); background-position: [1];', image, position);

            preview = Ext.String.format('<div class="x-emotion-banner-element-preview" style="[0]"></div>', style);
        }

        return preview;
    }
});
//{/block}