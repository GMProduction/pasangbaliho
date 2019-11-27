const onurl = 'https://pasangbaliho.com'

export async function loadAdvertiser () {
    let data = 0;
    try {
        let res = await axios.get(onurl+'/adminapi/mitra/requestAdvertiser');
        data = res.data;
    } catch (error) {
        alert(error)
    }
    return data;
}