(function (win) {
    var Scroll = function (option) {
        this.option = option;
    };
    Scroll.prototype = {
        init: function () {
            this.oldData = 900;
            this.newData = 800;
            this.arrOld = [0, 0, 7, 0, 0];
            this.arrNew = [0, 0, 6, 0, 0];
            this.direction = [];
            this.styleReturn();
        },
        dataGet: function (dataNum) {
            return dataNum  //Math.floor(Math.random() * 99999);
        },
        dataSolve: function (dataNum, oldNum) {
            var num = this.option.num;
            var _self = this;
            var newData = this.dataGet(dataNum), oldData = this.newData;
            this.newData = newData;
            var arrOld = [], arrNew = [];
            for (var i = 0; i < num; i++) {
                arrOld[num - 1 - i] = (parseInt(oldData) % 10);
                arrNew[num - 1 - i] = (parseInt(newData) % 10);
                newData = Math.floor(newData / 10);
                oldData = Math.floor(oldData / 10);
            }
            this.arrOld = arrOld;
            this.arrNew = arrNew;
            // _self.arrOld = arrOld;
            // _self.arrNew = arrNew;
            this.oldData = this.newData;
        },
        dataDisplay: function () {
            var _self = this;
            var $li = _self.option.dom.find("li");
            _self.direction = [];
            for (var i = 0; i < _self.option.num; i++) {
                _self.arrOld[i] > _self.arrNew[i] ? ($li.eq(i).find('.s-hide').attr("class", "s-hide s-top"), _self.direction.push('bottom')) : ($li.eq(i).find('.s-hide').attr("class", "s-hide s-bottom"), _self.direction.push('top'));
                $li.eq(i).find('.s-on').html(_self.arrOld[i]);
                $li.eq(i).find('.s-hide').html(_self.arrNew[i]);
            }
        },
        animate: function () {
            var _self = this;
            var $li = this.option.dom.find('li');
            $li.each(function (i) {
                $li.eq(i).css("transition", 0.5 * ($li.length - i) + "s").attr("class", "s-" + _self.direction[i]);
            });
        },
        styleReturn: function (newNum, oldNum) {
            var _self = this;
            var $li = _self.option.dom.find("li");
            //todo:这里处理一下
            this.dataSolve(newNum, oldNum)
            console.log(_self.arrNew);
            console.log(_self.arrOld);
            for (var i = 0; i < _self.option.num; i++) {
                $li.eq(i).find('.s-on').html(_self.arrNew[i]);
                $li.eq(i).find('.s-hide').html(_self.arrOld[i]);
            }
            $li.css("transition", "").attr('class', '');
            $li.find(".s-on").attr("class", "s-on"), $li.find(".s-hide").attr("class", "s-hide s-bottom");
        },
        run: function (dataNum, oldNum) {
            var _self = this;
            _self.init();
            _self.styleReturn(dataNum, oldNum);
            setTimeout(function () {
                _self.dataSolve(dataNum, oldNum);
                _self.dataDisplay();
                _self.animate();
            }, 3000);
        }
    }
    win.Scroll = Scroll;
})(window);