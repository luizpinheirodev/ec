// ---------------------------- GRÁFICO GERAL ----------------------------------------- //

var concPrazo = parseInt($("#concPrazo").html()); 
var concAtraso =  parseInt($('#concAtraso').html());
var naoConcAtraso = parseInt($("#naoConcAtraso").html()); 
var naoConc =  parseInt($('#naoConc').html());
concPrazo = concPrazo - concAtraso;
naoConc = naoConc - naoConcAtraso;

var total = (concPrazo + concAtraso + naoConcAtraso + naoConc);

var config = {
    type: 'doughnut',
    data: {
        datasets: [{
            data: [
                Math.round((concPrazo/total)*100),
                Math.round((concAtraso/total)*100),
                Math.round((naoConcAtraso/total)*100),
                Math.round((naoConc/total)*100)
            ],
            backgroundColor: [
                "#64C832",
                "#146E37",
                "#bf685f",    //"#70DB93"   ->Vermelho: #c45850
                "#DCDCDC"
            ],
            label: 'Dataset 1',
            borderColor: ["transparent","grey"],
            borderWidth: 0.1
        }],
        labels: [
            "Concluído",
            "Concluído em Atraso",
            "Em atraso",
            "No prazo",
        ]
    },
    options: {
        responsive: true,
        legend: {
            display: false,
            position: 'top',
        },
        /*title: {
            display: true,
            text: ''
        },*/
        animation: {
            animateScale: true,
            animateRotate: true
        }
    }
};

// ---------------------------- GRÁFICOS PRIMEIRA LINHA ----------------------------------------- //

//Grafico 1 - COOPERATIVAS
var concPrazo1 = parseInt($("#concPrazo1").html()); 
var concAtraso1 =  parseInt($('#concAtraso1').html());
var naoConcAtraso1 = parseInt($("#naoConcAtraso1").html()); 
var naoConc1 =  parseInt($('#naoConc1').html());
concPrazo1 = concPrazo1 - concAtraso1;
naoConc1 = naoConc1 - naoConcAtraso1;
var total1 = (concPrazo1 + concAtraso1 + naoConcAtraso1 + naoConc1);
var config1 = {
    type: 'doughnut',
    data: {
        datasets: [{
            data: [
                Math.round((concPrazo1/total1)*100),
                Math.round((concAtraso1/total1)*100),
                Math.round((naoConcAtraso1/total1)*100),
                Math.round((naoConc1/total1)*100)
            ],
            backgroundColor: [
                "#64C832",
                "#146E37",
                "#bf685f",    //"#70DB93"   ->Vermelho: #c45850
                "#DCDCDC"
            ],
            label: 'Dataset 1',
            borderColor: ["transparent","grey"],
            borderWidth: 0.1
        }],
        labels: [
            "Conc.",
            "C.Atraso",
            "Em atraso",
            "No prazo",
        ]
    },
    options: {
        responsive: true,
        legend: {
            display: false,
            position: 'top',
        },
        /*title: {
            display: true,
            text: ''
        },*/
        animation: {
            animateScale: true,
            animateRotate: true
        }
    }
};

//Grafico 2 - CENTRAIS
var concPrazo2 = parseInt($("#concPrazo2").html()); 
var concAtraso2 =  parseInt($('#concAtraso2').html());
var naoConcAtraso2 = parseInt($("#naoConcAtraso2").html()); 
var naoConc2 =  parseInt($('#naoConc2').html());
concPrazo2 = concPrazo2 - concAtraso2;
naoConc2 = naoConc2 - naoConcAtraso2;
var total2 = (concPrazo2 + concAtraso2 + naoConcAtraso2 + naoConc2);
var config2 = {
    type: 'doughnut',
    data: {
        datasets: [{
            data: [
                Math.round((concPrazo2/total2)*100),
                Math.round((concAtraso2/total2)*100),
                Math.round((naoConcAtraso2/total2)*100),
                Math.round((naoConc2/total2)*100)
            ],
            backgroundColor: [
                "#64C832",
                "#146E37",
                "#bf685f",    //"#70DB93"   ->Vermelho: #c45850
                "#DCDCDC"
            ],
            label: 'Dataset 1',
            borderColor: ["transparent","grey"],
            borderWidth: 0.1
        }],
        labels: [
            "Conc.",
            "C.Atraso",
            "Em atraso",
            "No prazo",
        ]
    },
    options: {
        responsive: true,
        legend: {
            display: false,
            position: 'top',
        },
        /*title: {
            display: true,
            text: ''
        },*/
        animation: {
            animateScale: true,
            animateRotate: true
        }
    }
};

//Grafico 3 - CONFEDERAÇÃO
var concPrazo3 = parseInt($("#concPrazo3").html()); 
var concAtraso3 =  parseInt($('#concAtraso3').html());
var naoConcAtraso3 = parseInt($("#naoConcAtraso3").html()); 
var naoConc3 =  parseInt($('#naoConc3').html());
concPrazo3 = concPrazo3 - concAtraso3;
naoConc3 = naoConc3 - naoConcAtraso3;
var total3 = (concPrazo3 + concAtraso3 + naoConcAtraso3 + naoConc3);
var config3 = {
    type: 'doughnut',
    data: {
        datasets: [{
            data: [
                Math.round((concPrazo3/total3)*100),
                Math.round((concAtraso3/total3)*100),
                Math.round((naoConcAtraso3/total3)*100),
                Math.round((naoConc3/total3)*100)
            ],
            backgroundColor: [
                "#64C832",
                "#146E37",
                "#bf685f",    //"#70DB93"   ->Vermelho: #c45850
                "#DCDCDC"
            ],
            label: 'Dataset 1',
            borderColor: ["transparent","grey"],
            borderWidth: 0.1
        }],
        labels: [
            "Conc.",
            "C.Atraso",
            "Em atraso",
            "No prazo",
        ]
    },
    options: {
        responsive: true,
        legend: {
            display: false,
            position: 'top',
        },
        /*title: {
            display: true,
            text: ''
        },*/
        animation: {
            animateScale: true,
            animateRotate: true
        }
    }
};

//Grafico 4 - CORRETORA
var concPrazo4 = parseInt($("#concPrazo4").html()); 
var concAtraso4 =  parseInt($('#concAtraso4').html());
var naoConcAtraso4 = parseInt($("#naoConcAtraso4").html()); 
var naoConc4 =  parseInt($('#naoConc4').html());
concPrazo4 = concPrazo4 - concAtraso4;
naoConc4 = naoConc4 - naoConcAtraso4;
var total4 = (concPrazo4 + concAtraso4 + naoConcAtraso4 + naoConc4);
var config4 = {
    type: 'doughnut',
    data: {
        datasets: [{
            data: [
                Math.round((concPrazo4/total4)*100),
                Math.round((concAtraso4/total4)*100),
                Math.round((naoConcAtraso4/total4)*100),
                Math.round((naoConc4/total4)*100)
            ],
            backgroundColor: [
                "#64C832",
                "#146E37",
                "#bf685f",    //"#70DB93"   ->Vermelho: #c45850
                "#DCDCDC"
            ],
            label: 'Dataset 1',
            borderColor: ["transparent","grey"],
            borderWidth: 0.1
        }],
        labels: [
            "Conc.",
            "C.Atraso",
            "Em atraso",
            "No prazo",
        ]
    },
    options: {
        responsive: true,
        legend: {
            display: false,
            position: 'top',
        },
        /*title: {
            display: true,
            text: ''
        },*/
        animation: {
            animateScale: true,
            animateRotate: true
        }
    }
};

// ---------------------------- GRÁFICOS SEGUNDA LINHA ----------------------------------------- //

//Grafico 5 - CONSÓRCIO
var concPrazo5 = parseInt($("#concPrazo5").html()); 
var concAtraso5 =  parseInt($('#concAtraso5').html());
var naoConcAtraso5 = parseInt($("#naoConcAtraso5").html()); 
var naoConc5 =  parseInt($('#naoConc5').html());
concPrazo5 = concPrazo5 - concAtraso5;
naoConc5 = naoConc5 - naoConcAtraso5;
var total5 = (concPrazo5 + concAtraso5 + naoConcAtraso5 + naoConc5);
var config5 = {
    type: 'doughnut',
    data: {
        datasets: [{
            data: [
                Math.round((concPrazo5/total5)*100),
                Math.round((concAtraso5/total5)*100),
                Math.round((naoConcAtraso5/total5)*100),
                Math.round((naoConc5/total5)*100)
            ],
            backgroundColor: [
                "#64C832",
                "#146E37",
                "#bf685f",    //"#70DB93"   ->Vermelho: #c45850
                "#DCDCDC"
            ],
            label: 'Dataset 1',
            borderColor: ["transparent","grey"],
            borderWidth: 0.1
        }],
        labels: [
            "Conc.",
            "C.Atraso",
            "Em atraso",
            "No prazo",
        ]
    },
    options: {
        responsive: true,
        legend: {
            display: false,
            position: 'top',
        },
        /*title: {
            display: true,
            text: ''
        },*/
        animation: {
            animateScale: true,
            animateRotate: true
        }
    }
};

//Grafico 6 - CARTÕES
var concPrazo6 = parseInt($("#concPrazo6").html()); 
var concAtraso6 =  parseInt($('#concAtraso6').html());
var naoConcAtraso6 = parseInt($("#naoConcAtraso6").html()); 
var naoConc6 =  parseInt($('#naoConc6').html());
concPrazo6 = concPrazo6 - concAtraso6;
naoConc6 = naoConc6 - naoConcAtraso6;
var total6 = (concPrazo6 + concAtraso6 + naoConcAtraso6 + naoConc6);
var config6 = {
    type: 'doughnut',
    data: {
        datasets: [{
            data: [
                Math.round((concPrazo6/total6)*100),
                Math.round((concAtraso6/total6)*100),
                Math.round((naoConcAtraso6/total6)*100),
                Math.round((naoConc6/total6)*100)
            ],
            backgroundColor: [
                "#64C832",
                "#146E37",
                "#bf685f",    //"#70DB93"   ->Vermelho: #c45850
                "#DCDCDC"
            ],
            label: 'Dataset 1',
            borderColor: ["transparent","grey"],
            borderWidth: 0.1
        }],
        labels: [
            "Conc.",
            "C.Atraso",
            "Em atraso",
            "No prazo",
        ]
    },
    options: {
        responsive: true,
        legend: {
            display: false,
            position: 'top',
        },
        /*title: {
            display: true,
            text: ''
        },*/
        animation: {
            animateScale: true,
            animateRotate: true
        }
    }
};

//Grafico 7 - BANCO
var concPrazo7 = parseInt($("#concPrazo7").html()); 
var concAtraso7 =  parseInt($('#concAtraso7').html());
var naoConcAtraso7 = parseInt($("#naoConcAtraso7").html()); 
var naoConc7 =  parseInt($('#naoConc7').html());
concPrazo7 = concPrazo7 - concAtraso7;
naoConc7 = naoConc7 - naoConcAtraso7;
var total7 = (concPrazo7 + concAtraso7 + naoConcAtraso7 + naoConc7);
var config7 = {
    type: 'doughnut',
    data: {
        datasets: [{
            data: [
                Math.round((concPrazo7/total7)*100),
                Math.round((concAtraso7/total7)*100),
                Math.round((naoConcAtraso7/total7)*100),
                Math.round((naoConc7/total7)*100)
            ],
            backgroundColor: [
                "#64C832",
                "#146E37",
                "#bf685f",    //"#70DB93"   ->Vermelho: #c45850
                "#DCDCDC"
            ],
            label: 'Dataset 1',
            borderColor: ["transparent","grey"],
            borderWidth: 0.1
        }],
        labels: [
            "Conc.",
            "C.Atraso",
            "Em atraso",
            "No prazo",
        ]
    },
    options: {
        responsive: true,
        legend: {
            display: false,
            position: 'top',
        },
        /*title: {
            display: true,
            text: ''
        },*/
        animation: {
            animateScale: true,
            animateRotate: true
        }
    }
};

//Grafico FUNDAÇÃO - FUNDAÇÃO
var concPrazo8 = parseInt($("#concPrazo8").html()); 
var concAtraso8 =  parseInt($('#concAtraso8').html());
var naoConcAtraso8 = parseInt($("#naoConcAtraso8").html()); 
var naoConc8 =  parseInt($('#naoConc8').html());
concPrazo8 = concPrazo8 - concAtraso8;
naoConc8 = naoConc8 - naoConcAtraso8;
var total8 = (concPrazo8 + concAtraso8 + naoConcAtraso8 + naoConc8);
var config8 = {
    type: 'doughnut',
    data: {
        datasets: [{
            data: [
                Math.round((concPrazo8/total8)*100),
                Math.round((concAtraso8/total8)*100),
                Math.round((naoConcAtraso8/total8)*100),
                Math.round((naoConc8/total8)*100)
            ],
            backgroundColor: [
                "#64C832",
                "#146E37",
                "#bf685f",    //"#70DB93"   ->Vermelho: #c45850
                "#DCDCDC"
            ],
            label: 'Dataset 1',
            borderColor: ["transparent","grey"],
            borderWidth: 0.1
        }],
        labels: [
            "Conc.",
            "C.Atraso",
            "Em atraso",
            "No prazo",
        ]
    },
    options: {
        responsive: true,
        legend: {
            display: false,
            position: 'top',
        },
        /*title: {
            display: true,
            text: ''
        },*/
        animation: {
            animateScale: true,
            animateRotate: true
        }
    }
};


// ---------------------------- GRÁFICOS TERCEIRA LINHA ----------------------------------------- //

//Grafico 10 - ADM DE BENS
var concPrazo10 = parseInt($("#concPrazo10").html()); 
var concAtraso10 =  parseInt($('#concAtraso10').html());
var naoConcAtraso10 = parseInt($("#naoConcAtraso10").html()); 
var naoConc10 =  parseInt($('#naoConc10').html());
concPrazo10 = concPrazo10 - concAtraso10;
naoConc10 = naoConc10 - naoConcAtraso10;
var total10 = (concPrazo10 + concAtraso10 + naoConcAtraso10 + naoConc10);
var config10 = {
    type: 'doughnut',
    data: {
        datasets: [{
            data: [
                Math.round((concPrazo10/total10)*100),
                Math.round((concAtraso10/total10)*100),
                Math.round((naoConcAtraso10/total10)*100),
                Math.round((naoConc10/total10)*100)
            ],
            backgroundColor: [
                "#64C832",
                "#146E37",
                "#bf685f",    //"#70DB93"   ->Vermelho: #c45850
                "#DCDCDC"
            ],
            label: 'Dataset 1',
            borderColor: ["transparent","grey"],
            borderWidth: 0.1
        }],
        labels: [
            "Conc.",
            "C.Atraso",
            "Em atraso",
            "No prazo",
        ]
    },
    options: {
        responsive: true,
        legend: {
            display: false,
            position: 'top',
        },
        /*title: {
            display: true,
            text: ''
        },*/
        animation: {
            animateScale: true,
            animateRotate: true
        }
    }
};

//Grafico 11 - SICREDIPAR
var concPrazo11 = parseInt($("#concPrazo11").html()); 
var concAtraso11 =  parseInt($('#concAtraso11').html());
var naoConcAtraso11 = parseInt($("#naoConcAtraso11").html()); 
var naoConc11 =  parseInt($('#naoConc11').html());
concPrazo11 = concPrazo11 - concAtraso11;
naoConc11 = naoConc11 - naoConcAtraso11;
var total11 = (concPrazo11 + concAtraso11 + naoConcAtraso11 + naoConc11);
var config11 = {
    type: 'doughnut',
    data: {
        datasets: [{
            data: [
                Math.round((concPrazo11/total11)*100),
                Math.round((concAtraso11/total11)*100),
                Math.round((naoConcAtraso11/total11)*100),
                Math.round((naoConc11/total11)*100)
            ],
            backgroundColor: [
                "#64C832",
                "#146E37",
                "#bf685f",    //"#70DB93"   ->Vermelho: #c45850
                "#DCDCDC"
            ],
            label: 'Dataset 1',
            borderColor: ["transparent","grey"],
            borderWidth: 0.1
        }],
        labels: [
            "Conc.",
            "C.Atraso",
            "Em atraso",
            "No prazo",
        ]
    },
    options: {
        responsive: true,
        legend: {
            display: false,
            position: 'top',
        },
        /*title: {
            display: true,
            text: ''
        },*/
        animation: {
            animateScale: true,
            animateRotate: true
        }
    }
};

//Grafico 12 - SFG
var concPrazo12 = parseInt($("#concPrazo12").html()); 
var concAtraso12 =  parseInt($('#concAtraso12').html());
var naoConcAtraso12 = parseInt($("#naoConcAtraso12").html()); 
var naoConc12 =  parseInt($('#naoConc12').html());
concPrazo12 = concPrazo12 - concAtraso12;
naoConc12 = naoConc12 - naoConcAtraso12;
var total12 = (concPrazo12 + concAtraso12 + naoConcAtraso12 + naoConc12);
var config12 = {
    type: 'doughnut',
    data: {
        datasets: [{
            data: [
                Math.round((concPrazo12/total12)*100),
                Math.round((concAtraso12/total12)*100),
                Math.round((naoConcAtraso12/total12)*100),
                Math.round((naoConc12/total12)*100)
            ],
            backgroundColor: [
                "#64C832",
                "#146E37",
                "#bf685f",    //"#70DB93"   ->Vermelho: #c45850
                "#DCDCDC"
            ],
            label: 'Dataset 1',
            borderColor: ["transparent","grey"],
            borderWidth: 0.1
        }],
        labels: [
            "Conc.",
            "C.Atraso",
            "Em atraso",
            "No prazo",
        ]
    },
    options: {
        responsive: true,
        legend: {
            display: false,
            position: 'top',
        },
        /*title: {
            display: true,
            text: ''
        },*/
        animation: {
            animateScale: true,
            animateRotate: true
        }
    }
};

//Grafico 13 - CONDOMINIO
var concPrazo13 = parseInt($("#concPrazo13").html()); 
var concAtraso13 =  parseInt($('#concAtraso13').html());
var naoConcAtraso13 = parseInt($("#naoConcAtraso13").html()); 
var naoConc13 =  parseInt($('#naoConc13').html());
concPrazo13 = concPrazo13 - concAtraso13;
naoConc13 = naoConc13 - naoConcAtraso13;
var total13 = (concPrazo13 + concAtraso13 + naoConcAtraso13 + naoConc13);
var config13 = {
    type: 'doughnut',
    data: {
        datasets: [{
            data: [
                Math.round((concPrazo13/total13)*100),
                Math.round((concAtraso13/total13)*100),
                Math.round((naoConcAtraso13/total13)*100),
                Math.round((naoConc13/total13)*100)
            ],
            backgroundColor: [
                "#64C832",
                "#146E37",
                "#bf685f",    //"#70DB93"   ->Vermelho: #c45850
                "#DCDCDC"
            ],
            label: 'Dataset 1',
            borderColor: ["transparent","grey"],
            borderWidth: 0.1
        }],
        labels: [
            "Conc.",
            "C.Atraso",
            "Em atraso",
            "No prazo",
        ]
    },
    options: {
        responsive: true,
        legend: {
            display: false,
            position: 'top',
        },
        /*title: {
            display: true,
            text: ''
        },*/
        animation: {
            animateScale: true,
            animateRotate: true
        }
    }
};




//GRAFICO DIAS -------------------------------------------//
//var meses = ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"];
//var dias = parseInt($("#var7Conc").html()); 
var dias = {
    type: 'bar',
    data: {
      labels: ["Novembro", "Dezembro", "Janeiro", "Fevereiro", "Março", "Abril", "Maio"],
      datasets: [
        {
          label: "Dias (quantidade)",
          backgroundColor: ["#146E37", "#146E37","#146E37","#146E37","#146E37", "#146E37", "#146E37"],
          data: [5,5,6,5,6,4,5]
          
        }
      ],
    },
    options: {
      legend: { display: false },
      title: {
        display: true,
        //text: 'HISTORICO - Fechamento em dias úteis'
        },
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
};


//Grafico - 14 Críticas Contas
var qtd14 = parseInt($("#qtd14").html()); 
var qtdConc14 =  parseInt($('#qtdConc14').html());
var config14 = {
    type: 'doughnut',
    data: {
        datasets: [{
            data: [
                Math.round((qtdConc14/qtd14)*100),
                Math.round(((qtd14-qtdConc14)/qtd14)*100),
            ],
            backgroundColor: [
                "#64C832",
                "#DCDCDC"
            ],
            label: 'Dataset 1',
            borderColor: ["transparent","grey"],
            borderWidth: 0.1
        }],
        labels: [
            "Conc.",
            "Não Conc.",
        ]
    },
    options: {
        responsive: true,
        legend: {
            display: false,
            position: 'top',
        },
        /*title: {
            display: true,
            text: ''
        },*/
        animation: {
            animateScale: true,
            animateRotate: true
        }
    }
};


window.onload = function() {
    var ctx = document.getElementById("grafTotal").getContext("2d");
    window.myDoughnut2 = new Chart(ctx, config);

    var ctx1 = document.getElementById("chart1").getContext("2d");
    window.myDoughnut2 = new Chart(ctx1, config1);

    var ctx2 = document.getElementById("chart2").getContext("2d");
    window.myDoughnut2 = new Chart(ctx2, config2);

    var ctx3 = document.getElementById("chart3").getContext("2d");
    window.myDoughnut2 = new Chart(ctx3, config3);

    var ctx4 = document.getElementById("chart4").getContext("2d");
    window.myDoughnut2 = new Chart(ctx4, config4);

    var ctx5 = document.getElementById("chart5").getContext("2d");
    window.myDoughnut2 = new Chart(ctx5, config5);

    var ctx6 = document.getElementById("chart6").getContext("2d");
    window.myDoughnut2 = new Chart(ctx6, config6);

    var ctx7 = document.getElementById("chart7").getContext("2d");
    window.myDoughnut2 = new Chart(ctx7, config7);

    var ctx8 = document.getElementById("chart8").getContext("2d");
    window.myDoughnut2 = new Chart(ctx8, config8);

    var ctx10 = document.getElementById("chart10").getContext("2d");
    window.myDoughnut2 = new Chart(ctx10, config10);

    var ctx11 = document.getElementById("chart11").getContext("2d");
    window.myDoughnut2 = new Chart(ctx11, config11);

    var ctx12 = document.getElementById("chart12").getContext("2d");
    window.myDoughnut2 = new Chart(ctx12, config12);

    var ctx13 = document.getElementById("chart13").getContext("2d");
    window.myDoughnut2 = new Chart(ctx13, config13);

    var diasbar = document.getElementById("chart-bar-lin").getContext("2d");
    window.myDoughnut2 = new Chart(diasbar, dias);

    var ctx14 = document.getElementById("chart14").getContext("2d");
    window.myDoughnut2 = new Chart(ctx14, config14);
    
};   
    