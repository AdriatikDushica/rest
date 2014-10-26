function Resource($http, path){

    this.path = path;

    /**
     * Request of type GET to the web service
     * @param callback
     */
    this.index = function(callback){
        $http.get(this.path, {})
            .success(function(result){
                callback(result);
            });
    }


    /**
     * Request of type POST to the web service
     * @param object
     * @param callback
     */
    this.store = function(object, callback){
        $http.post(this.path, object)
            .success(function(result){
                callback(result);
            });
    }

    /**
     * Request of type PUT to the web service
     * @param object
     * @param callback
     */
    this.update = function(object, callback){
        path = this.path + '/' + object.id;

        $http.put(path, object)
            .success(function(result){
                callback(result);
            });
    }

    /**
     * Request of type DELETE to the web service
     * @param id
     * @param callback
     */
    this.destroy = function(id, callback){
        path = this.path + '/' + id;

        $http.delete(path, {})
            .success(function(result){
                callback(result);
            });
    }

}