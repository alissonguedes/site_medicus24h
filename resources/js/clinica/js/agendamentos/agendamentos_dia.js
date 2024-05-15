 /**
  * Função para abrir os detalhes do agendamento de um dia específico
  */
 function agendamentos_dia() {

     $('.preloader').removeClass('skeleton');
     setTimeout(function () {
         $('#agendamentos_dia tr.hoverable').unbind().bind('click', function () {
             var id = $(this).attr('id').split('event_').slice(1).join();
             event_details(id);
         });
     }, 200);

 }

 agendamentos_dia();
