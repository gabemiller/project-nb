
<footer>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                <h3>Elérhetőség</h3>
                <dl>
                    <dt>Polgármesteri hivatal</dt>
                    <dd>3641 Nagybarca, Kossuth u. 32.</dd>
                    <dt>Telefon</dt>
                    <dd>+36 48 500-224</dd>
                    <dt>Fax</dt>
                    <dd>+36 48 500-224</dd>
                    <dt>Email</dt>
                    <dd>{{HTML::mailto('barcaph@freemail.hu')}}</dd>
                </dl>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 hidden-xs hidden-sm">
                <h3>Legfrissebb hírek</h3>

                @foreach($articleFooter as $article)
                <div class="article-footer">
                    <h4>{{HTML::linkRoute('hirek.show',$article->title,array('id'=>$article->id,'title'=>$article->id))}}</h4>
                    <p class="small text-muted">Írta: {{$article->getAuthorName()}} | Létrehozva: {{$article->getCreateDate()}} </p>
                </div>
                @endforeach
            </div>
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 hidden-xs hidden-sm">
                <h3>Információ</h3>
                <a href="http://nagybarca.hu/oldal/61/allaslehetosegek">Álláslehetőség</a>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <p class="footer-text">© 2014 Nagybarca - Minden jog fenntartva.</p>  
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        {{HTML::decode(HTML::link('http://divide.hu','<h5 class="footer-logo">Divide.hu</h5>',array('target'=>'_blank','class'=>'footer-logo-link')))}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>