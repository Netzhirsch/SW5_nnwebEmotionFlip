//{block name="backend/Emotion/app" append}
Ext.define('Shopware.apps.nnwebEmotionFlip.store.HeadlineTagStore', {
	extend : 'Ext.data.Store',
	fields : [ {
		name : 'id',
		type : 'integer'
	}, {
		name : 'name',
		type : 'string'
	},
	{
		name : 'value',
		type : 'string'
	}],
	data : [ {
		id : 1,
		name : "H1",
		value : "h1"		
	}, {
		id : 2,
		name : "H2",
		value : "h2"
	}, {
		id : 3,
		name : "H3",
		value : "h3"
	}, {
		id : 4,
		name : "H3",
		value : "h3"
	}, {
		id : 5,
		name : "H4",
		value : "h4"
	}, {
		id : 6,
		name : "H5",
		value : "h5"
	}, {
		id : 7,
		name : "H6",
		value : "h6"
	}]
});

Ext.define('Shopware.apps.nnwebEmotionFlip.store.TextAlignStore', {
	extend : 'Ext.data.Store',
	fields : [ {
		name : 'id',
		type : 'integer'
	}, {
		name : 'name',
		type : 'string'
	},
	{
		name : 'value',
		type : 'string'
	}],
	data : [ {
		id : 1,
		name : "Links",
		value : "left"		
	}, {
		id : 2,
		name : "Mitte",
		value : "center"
	}, {
		id : 3,
		name : "Rechts",
		value : "right"
	}, {
		id : 4,
		name : "Blocksatz",
		value : "justify"
	}]
});

Ext.define('Shopware.apps.nnwebEmotionFlip.store.LinkTargetStore', {
	extend : 'Ext.data.Store',
	fields : [ {
		name : 'id',
		type : 'integer'
	}, {
		name : 'name',
		type : 'string'
	},
	{
		name : 'value',
		type : 'string'
	}],
	data : [ {
		id : 1,
		name : "Selbes Fenster",
		value : "_self"		
	}, {
		id : 2,
		name : "Neues Fenster",
		value : "_blank"
	}]
});

Ext.define('Shopware.apps.nnwebEmotionFlip.store.BoxAlignXStore', {
	extend : 'Ext.data.Store',
	fields : [ {
		name : 'id',
		type : 'integer'
	}, {
		name : 'name',
		type : 'string'
	},
	{
		name : 'value',
		type : 'string'
	}],
	data : [ {
		id : 1,
		name : "Links",
		value : "box-left"		
	}, {
		id : 2,
		name : "Mitte",
		value : "box-center-x"
	}, {
		id : 3,
		name : "Rechts",
		value : "box-right"
	},]
});

Ext.define('Shopware.apps.nnwebEmotionFlip.store.BoxAlignYStore', {
	extend : 'Ext.data.Store',
	fields : [ {
		name : 'id',
		type : 'integer'
	}, {
		name : 'name',
		type : 'string'
	},
	{
		name : 'value',
		type : 'string'
	}],
	data : [ {
		id : 1,
		name : "Oben",
		value : "box-top"		
	}, {
		id : 2,
		name : "Mitte",
		value : "box-center-y"
	}, {
		id : 3,
		name : "Unten",
		value : "box-bottom"
	},]
});

Ext.define('Shopware.apps.nnwebEmotionFlip.store.HintergrundPositionStore', {
	extend : 'Ext.data.Store',
	fields : [ {
		name : 'id',
		type : 'integer'
	}, {
		name : 'name',
		type : 'string'
	},
	{
		name : 'value',
		type : 'string'
	}],
	data : [ {
		id : 1,
		name : "links oben",
		value : "left top"		
	}, {
		id : 2,
		name : "links mittig",
		value : "left center"
	}, {
		id : 3,
		name : "links unten",
		value : "left bottom"
	}, {
		id : 4,
		name : "mittig oben",
		value : "center top"
	}, {
		id : 5,
		name : "mittig mittig",
		value : "center center"
	}, {
		id : 6,
		name : "mittig unten",
		value : "center bottom"
	}, {
		id : 7,
		name : "rechts oben",
		value : "right top"
	}, {
		id : 8,
		name : "rechts mittig",
		value : "right center"
	}, {
		id : 9,
		name : "rechts unten",
		value : "right bottom"
	}]
});

Ext.define('Shopware.apps.nnwebEmotionFlip.store.FlipDirection', {
	extend : 'Ext.data.Store',
	fields : [ {
		name : 'id',
		type : 'integer'
	}, {
		name : 'name',
		type : 'string'
	},
	{
		name : 'value',
		type : 'string'
	}],
	data : [ {
		id : 1,
		name : "Von links",
		value : "from_left"		
	},{
		id : 2,
		name : "Von rechts",
		value : "from_right"
	},{
		id : 3,
		name : "Von oben",
		value : "from_top"
	},{
		id : 4,
		name : "Von unten",
		value : "from_bottom"
	}]
});

// {/block}
