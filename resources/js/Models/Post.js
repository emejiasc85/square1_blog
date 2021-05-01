class Post {
    static get(params, then) {
        axios.get('/api/v1/posts', {
            params: params
        })
            .then(({data}) => then(data));
    }
    
    static show(element, then) {
        axios.get('/api/v1/posts/'+element)
            .then(({data}) => then(data));
    }

}

export default Post;