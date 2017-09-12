var config = {
    map: {
        '*': {
            favorites: 'TWS_Favorites/js/favorites'
        }
    },
	paths:{
		"favorites":"TWS/Favorites/view/frontend/web"
	},
	shim:{
		'favorites':{
			'deps':['jquery']
		}
	}
};