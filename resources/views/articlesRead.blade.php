<style>
    article {
        display: grid;
        grid-template-columns: 1fr 1fr 10px 740px 10px 1fr 1fr;
        background-color: whitesmoke;

    }

    article > * {
        grid-column: 4;
    }

    h1 { color: #111; font-family: 'Open Sans Condensed', sans-serif; font-size: 64px; font-weight: 700; line-height: 64px; margin: 0 0 0; padding: 20px 30px; text-align: center; text-transform: uppercase; }
    h2 { color: #111; font-family: 'Open Sans Condensed', sans-serif; font-size: 48px; font-weight: 700; line-height: 48px; margin: 0 0 24px; padding: 0 30px; text-align: center; text-transform: uppercase; }
    p { color: #111; font-family: 'Open Sans', sans-serif; font-size: 16px; line-height: 28px; margin: 0 0 48px; }


</style>


    <div class="container">
      <article>
          <h1>{{$article->title}}</h1>
          <p>
              {{$article->body}}
          </p>
      </article>
    </div>

