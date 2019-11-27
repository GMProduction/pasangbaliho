const offurl = 'http://localhost:8000';
const onurl = 'http://genossys.site'

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