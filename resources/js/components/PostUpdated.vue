
<script>
    export default{
        data() {
            return{
                messages: [],
                message: '',
                channel: null,
            }
        },

        mounted(){
                this.channel = Echo.private('postUpdated');
    
                this.channel.listen('PostUpdated', (data) => {
                    console.log(data);
                    let message = 'Изменена статья ' + data['title'] + '. \n Изменены следующие поля:';
                    var changedFields = JSON.parse(data['changedFields']);
                    message += Object.keys(changedFields);

                    message += '\n Ссылка на статью: <a href="'+data['link']+'">Посмотреть статью</a>';
                    
                    alert(message);
                })
        },
        methods:
        {

        },
    }
</script>