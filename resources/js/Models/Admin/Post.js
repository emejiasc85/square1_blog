class Post {
    static get(params, then) {
        axios.get('/api/v1/admin/posts', {
            params: params
        })
            .then(({data}) => then(data));
    }

    static store(data, then, error) {
        axios.post('/api/v1/admin/posts/', data)
            .then(({data}) => then(data))
            .catch(({response}) => error(response.data.errors));
    }
}

export default Post;