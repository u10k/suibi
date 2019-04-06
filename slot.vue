<template>
  <div class="hello">
    <p style='color:red;'>{{log('render')}}</p>
    <InputModel v-model="inputInfo" :size-val.sync="sizeVal"/>
    {{inputInfo}}
    {{sizeVal}}
    <h2>老语法</h2>
    <SoltDemo>
      <h2>老语法</h2>
      <p>old</p>
      <p slot="title">titleold</p>
      <p slot="title">titleold2</p>
      <p slot="item" slot-scope="props">item old {{ props }}</p>
      <p slot="item2" slot-scope="props">item old {{ props.value }}</p>
      <p slot="item3" slot-scope="props">item old {{ props.value }}</p>
    </SoltDemo>
    <h2>新语法</h2>
    <SoltDemo>
      <template v-slot:title>
        <p>titlenew</p>
        <p>titlenew1</p>
      </template>
      <template v-slot:item="props">
        <p>item new {{props}}</p>
      </template>
    </SoltDemo>
    <button @click="onclickHandler">按钮</button>
    <VNodes/>
  </div>
</template>

<script>
  import SoltDemo from './SoltDemo.vue'
  import InputModel from './InputModel.vue'
export default {
  name: 'HelloWorld',
  data(){
    this.log = window.console.log;
    return {
      inputInfo:{
        val1:'+86',
        val2:'123'
      },
      sizeVal:'456'
    }
  },
  components: {
    SoltDemo,
    InputModel,
    VNodes:{
      functional: true,
      render:(h, ctx) => ctx.props.vnodes
    }
  },
  methods:{
    onclickHandler(){
      console.log(this.$createElement('p','huwenzhe'))
      return this.$createElement('p','defalut slot')
    }
  }
}
</script>

<style scoped>
</style>
