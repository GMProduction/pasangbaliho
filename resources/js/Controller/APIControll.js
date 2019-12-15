export async function fetchAPI (apiURL) {
    try {
        let res = await axios.get(apiURL);
        return {data: res, status: 'success'}
    } catch (error) {
        alert('Terjadi Kesalahan Dalam Melakukan Fetch Data!\n'+error)
        return {status: 'error', data: error}
    }
}

export async function postAPI (apiURL, data, config) {
    try {
        let res = await axios.post(apiURL, data);
        return {data: res, status: 'success'}
    } catch (error) {
        alert('Terjadi Kesalahan Dalam Melakukan Fetch Data!\n'+error)
        return {status: 'error', data: error}
    }
}