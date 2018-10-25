<style>
    article {
        display: grid;
        grid-template-columns: 1fr 1fr 10px 740px 10px 1fr 1fr;
    }

    article > * {
        grid-column: 4;
    }
</style>

@foreach($articles as $article)
    <div class="container">
      <article>
          <h1>{{$article->title}}</h1>
          <p>
              {{$article->body}}
          </p>
      </article>
    </div>


@endforeach
