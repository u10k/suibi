<template>
  <div>
        <span>{{text}}</span>
        <a-input defaultValue="123" v-model="text" @input="inputIsChange"></a-input>
        <a-button type="danger" @click="searchSubmit">提交</a-button>
  </div>
</template>
<script>
import util from "./util";
export default {
  data(){
    return{
        text: ''
    }
  },
  methods:{
      inputIsChange:util.debounce(function() {
              console.log('change');
          }, 200),
      searchSubmit:util.debounce(function() {
          console.log('Submit');
      }, 200)
  }
};
</script>

// util.js
export default {
    debounce(fn, delay = 300) {   //默认300毫秒
        var timer;
        return function() {
            var args = arguments;
            if(timer) {
                clearTimeout(timer);
            }
            timer = setTimeout(() => {
                fn.apply(this, args);   // this 指向vue
            }, delay);
        };
    }
}



