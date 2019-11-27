const onurl = 'https://pasangbaliho.com'

export async function loadMitra () {
    let data = 0;
    try {
        let res = await axios.get(onurl+'/adminapi/mitra/request');
        data = res.data;
    } catch (error) {
        alert(error)
    }
    return data;
}