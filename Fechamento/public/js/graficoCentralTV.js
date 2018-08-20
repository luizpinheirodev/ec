

// ---------------------------- GRÁFICO GERAL ----------------------------------------- //

var concPrazo = parseInt($("#concPrazo").html()); 
var concAtraso =  parseInt($('#concAtraso').html());
var naoConcAtraso = parseInt($("#naoConcAtraso").html()); 
var naoConc =  parseInt($('#naoConc').html());
concPrazo = concPrazo - concAtraso;
naoConc = naoConc - naoConcAtraso;


var config = {
    type: 'doughnut',
    data: {
        datasets: [{
            data: [
                concPrazo,
                concAtraso,
                naoConcAtraso,
                naoConc
            ],
            backgroundColor: [
                "#007475",
                "#105A5A",
                "#bf685f",    //"#70DB93"   ->Vermelho: #c45850
                "transparent"
            ],
            label: 'Dataset 1',
            borderColor: ["transparent","grey"],
            borderWidth: 0.1
        }],
        labels: [
            "Concluído",
            "Concluído em Atraso",
            "Em atraso",
            "Não Concluído",
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
        },
        //circumference: 5
        cutoutPercentage: 60,
       
    },
    centerText: {
        display: true,
        text: "280"
    }
};

// ---------------------------- GRÁFICOS PRIMEIRA LINHA ----------------------------------------- //

//Grafico 1 - COOPERATIVAS
var concPrazo1 = parseInt($("#concPrazo1").html()); 
var concAtraso1 =  parseInt($('#concAtraso1').html());
var naoConcAtraso1 = parseInt($("#naoConcAtraso1").html()); 
var naoConc1 =  parseInt($('#naoConc1').html());
var total1 = concPrazo1 + naoConc1;
concPrazo1 = concPrazo1 - concAtraso1;
naoConc1 = naoConc1 - naoConcAtraso1;
var config1 = {
    type: 'doughnut',
    data: {
        datasets: [{
            data: [
                concPrazo1,
                concAtraso1,
                naoConcAtraso1,
                naoConc1
            ],
            backgroundColor: [
                "#007475",
                "#105A5A",
                "#bf685f",    //"#70DB93"   ->Vermelho: #c45850
                "transparent"
            ],
            label: 'Dataset 1',
            borderColor: ["transparent","grey"],
            borderWidth: 0.1
        }],
        labels: [
            "Concluído",
            "Concluído em Atraso",
            "Em atraso",
            "Não Concluído",
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
var total2 = concPrazo2 + naoConc2;
concPrazo2 = concPrazo2 - concAtraso2;
naoConc2 = naoConc2 - naoConcAtraso2;
var config2 = {
    type: 'doughnut',
    data: {
        datasets: [{
            data: [
                concPrazo2,
                concAtraso2,
                naoConcAtraso2,
                naoConc2
            ],
            backgroundColor: [
                "#007475",
                "#105A5A",
                "#bf685f",    //"#70DB93"   ->Vermelho: #c45850
                "transparent"
            ],
            label: 'Dataset 1',
            borderColor: ["transparent","grey"],
            borderWidth: 0.1
        }],
        labels: [
            "Concluído",
            "Concluído em Atraso",
            "Em atraso",
            "Não Concluído",
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
var total3 = concPrazo3 + naoConc3;
var config3 = {
    type: 'doughnut',
    data: {
        datasets: [{
            data: [
                concPrazo3,
                concAtraso3,
                naoConcAtraso3,
                naoConc3
            ],
            backgroundColor: [
                "#007475",
                "#105A5A",
                "#bf685f",    //"#70DB93"   ->Vermelho: #c45850
                "transparent"
            ],
            label: 'Dataset 1',
            borderColor: ["transparent","grey"],
            borderWidth: 0.1
        }],
        labels: [
            "Concluído",
            "Concluído em Atraso",
            "Em atraso",
            "Não Concluído",
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
var total4 = concPrazo4 + naoConc4;
concPrazo4 = concPrazo4 - concAtraso4;
naoConc4 = naoConc4 - naoConcAtraso4;
var config4 = {
    type: 'doughnut',
    data: {
        datasets: [{
            data: [
                concPrazo4,
                concAtraso4,
                naoConcAtraso4,
                naoConc4
            ],
            backgroundColor: [
                "#007475",
                "#105A5A",
                "#bf685f",    //"#70DB93"   ->Vermelho: #c45850
                "transparent"
            ],
            label: 'Dataset 1',
            borderColor: ["transparent","grey"],
            borderWidth: 0.1
        }],
        labels: [
            "Concluído",
            "Concluído em Atraso",
            "Em atraso",
            "Não Concluído",
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
var total5 = concPrazo5 + naoConc5;
concPrazo5 = concPrazo5 - concAtraso5;
naoConc5 = naoConc5 - naoConcAtraso5;
var config5 = {
    type: 'doughnut',
    data: {
        datasets: [{
            data: [
                concPrazo5,
                concAtraso5,
                naoConcAtraso5,
                naoConc5
            ],
            backgroundColor: [
                "#007475",
                "#105A5A",
                "#bf685f",    //"#70DB93"   ->Vermelho: #c45850
                "transparent"
            ],
            label: 'Dataset 1',
            borderColor: ["transparent","grey"],
            borderWidth: 0.1
        }],
        labels: [
            "Concluído",
            "Concluído em Atraso",
            "Em atraso",
            "Não Concluído",
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
var total6 = concPrazo6 + naoConc6;
concPrazo6 = concPrazo6 - concAtraso6;
naoConc6 = naoConc6 - naoConcAtraso6;
var config6 = {
    type: 'doughnut',
    data: {
        datasets: [{
            data: [
                concPrazo6,
                concAtraso6,
                naoConcAtraso6,
                naoConc6
            ],
            backgroundColor: [
                "#007475",
                "#105A5A",
                "#bf685f",    //"#70DB93"   ->Vermelho: #c45850
                "transparent"
            ],
            label: 'Dataset 1',
            borderColor: ["transparent","grey"],
            borderWidth: 0.1
        }],
        labels: [
            "Concluído",
            "Concluído em Atraso",
            "Em atraso",
            "Não Concluído",
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
var total7 = concPrazo7 + naoConc7;
concPrazo7 = concPrazo7 - concAtraso7;
naoConc7 = naoConc7 - naoConcAtraso7;
var config7 = {
    type: 'doughnut',
    data: {
        datasets: [{
            data: [
                concPrazo7,
                concAtraso7,
                naoConcAtraso7,
                naoConc7
            ],
            backgroundColor: [
                "#007475",
                "#105A5A",
                "#bf685f",    //"#70DB93"   ->Vermelho: #c45850
                "transparent"
            ],
            label: 'Dataset 1',
            borderColor: ["transparent","grey"],
            borderWidth: 0.1
        }],
        labels: [
            "Concluído",
            "Concluído em Atraso",
            "Em atraso",
            "Não Concluído",
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
var total8 = concPrazo8 + naoConc8;
concPrazo8 = concPrazo8 - concAtraso8;
naoConc8 = naoConc8 - naoConcAtraso8;
var config8 = {
    type: 'doughnut',
    data: {
        datasets: [{
            data: [
                concPrazo8,
                concAtraso8,
                naoConcAtraso8,
                naoConc8
            ],
            backgroundColor: [
                "#007475",
                "#105A5A",
                "#bf685f",    //"#70DB93"   ->Vermelho: #c45850
                "transparent"
            ],
            label: 'Dataset 1',
            borderColor: ["transparent","grey"],
            borderWidth: 0.1
        }],
        labels: [
            "Concluído",
            "Concluído em Atraso",
            "Em atraso",
            "Não Concluído",
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
var concPrazo9 = parseInt($("#concPrazo9").html()); 
var naoConc9 =  parseInt($('#naoConc9').html());
var concPrazo10 = parseInt($("#concPrazo10").html()); 
var naoConc10 =  parseInt($('#naoConc10').html());

var total9 = concPrazo9+naoConc9;
var total10 = concPrazo10+naoConc10;
var dias = {
    type: 'bar',
    data: {
      labels: ["Cooperativas", "Centrais", "Confederação", "Corretora", "Consórcio", "Cartões", "Banco", "Fundação", "Fundos", "Adm. de Bens"],
      fontColor: "#000000",
      datasets: [
        {
          label: "Dias (quantidade)",
          backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850", "#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
          data: [
            total1,
            total2,
            total3,
            total4,
            total5,
            total6,
            total7,
            total8,
            total9,
            total10,
            ]
        }
      ],
    },
    options: {
      labels: {
            fontColor: "white",
        },
      legend: { 
          display: false,
          fontColor: "white"
        },
      title: {
        display: false,
        text: 'Quantidade de Processos'
        },
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true,
                    fontColor: "white"
                }
            }],
            xAxes: [{
                ticks: {
                    beginAtZero:true,
                    fontColor: "white"
                }
            }]
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

    var diasbar = document.getElementById("chart-bar-emp").getContext("2d");
    window.myDoughnut2 = new Chart(diasbar, dias);
  
 
};   


    