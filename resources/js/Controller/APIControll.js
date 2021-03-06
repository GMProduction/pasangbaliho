
export const mainApi = axios.create({
    baseURL: 'https://www.pasangbaliho.com/api/admin/v1',
    // baseURL: 'http://localhost:8000/api/admin/v1',
    // baseURL: 'http://genossys.site/adminapi',
});

export const genosAPI = axios.create({
    baseURL: 'http://genossys.site/adminapi',
});


export async function fetchAPI (apiURL) {

    
    try {
        let res = await mainApi.get(apiURL);
        return {data: res, status: 'success'}
    } catch (error) {
        alert('Terjadi Kesalahan Dalam Melakukan Fetch Data!\n'+error)
        return {status: 'error', data: error}
    }
}

export async function postAPI (apiURL, data, config) {
    try {
        let res = await mainApi.post(apiURL, data);
        return {data: res, status: 'success'}
    } catch (error) {
        alert('Terjadi Kesalahan Dalam Melakukan Fetch Data!\n'+error)
        return {status: 'error', data: error}
    }
}

export async function deleteAPI (apiURL, data) {
    try {
        let res = await mainApi.delete(apiURL, {params: data});
        return {data: res, status: 'success'}
    } catch (error) {
        alert('Terjadi Kesalahan Dalam Melakukan Fetch Data!\n'+error)
        return {status: 'error', data: error}
    }
}

