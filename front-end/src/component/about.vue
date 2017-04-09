<template>
  <div>
    test
  </div>
</template>

<style type="text/css">
	div {
		/*color: red;*/
	}
</style>

<script>

export default {
	data() {
		return {
		message: 'hello!'
		}
	},
	created() {
		this.message = 'bye!'
	}
}

</script>