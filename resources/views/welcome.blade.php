<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Magnifique Couple</title>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@600&display=swap" rel="stylesheet">

        <meta property="og:title" content="Magnifique Couple">
        <meta property="og:image" content="https://magnificouple.projetretro.io/mc.png">

        <style>
            body {
                font-family: 'JetBrains Mono', monospace;
            }

            .has-background-royal {
                background-color: #021945;
            }

        </style>

    </head>
    <body class="antialiased has-background-royal has-text-white">
    <section class="section ">
        <div class="container">
            <h1 class="title has-text-white">
                <u>Magnifique Couple</u>
            </h1>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <h3 class="subtitle has-text-white">
                <u>Magnifique couple</u> is software conceive to scrap pictures, videos, gifs and others from various over Internet.
                Following is the log of my journey to build this software.
            </h3>
        </div>
    </section>

    <section class="section">
        <div class="container has-text-justify">
            <h4><u>0. Before the Storm</u></h4>
            <p>I don't really remember how it started, what was the spark to ignite the project.</p>
            <p>A couple of years ago I joined a discord server on the invitation of a friend. This server had been built by people sharing common tastes in porn and had a lively community.</p>
            <p>As I often do, I missed that gold age, only seeing the place as a joke, where people mainly come to find spank materials.</p>
            <p>One day, I decided to actually start talking on this server and I discovered a community full of interesting peoples, not only their stories but their views of the world.</p>
            <p>The more I talked with them, the more I understood that the porn was mainly a facade for the community.</p>
            <p>Yet, I envied the peoples who where courageous enough to shares their bodies on the server. I wanted to give something back to that community that had welcomed me.</p>
            <p><br /></p>
            <p>As I was reflecting on my lack of physical attributes to share with the community, I turned my attention to my actual strength : my brain.</p>
            <p>The obvious idea was to find content for the various sex themed channels yet everybody can do that and I wanted to do things my way.</p>
            <p>By the past, I had already played with that kind of idea, especially in Discord bot distributing porn on demand, but I would had to do thing differently this time.</p>
            <p><br /></p>
            <p>Differently because Tumblr banned porn and it was my only source. Fortunately since the Tumblr tumbling I found another source of unlimited porn : Reddit</p>
            <p>Now that the idea has been planted in my mind, it's was time to code it.</p>
        </div>
    </section>

    <section class="section">
        <div class="container has-text-justify">
            <h4><u>1. <i>Beau Gosse</i></u></h4>
            <p>As a developer, I think I share a common fear with artists and writers : the blank page.</p>
            <p>In my case this fear can happen as soon I create a new project since the first question I'm asked is : Name of the project ?</p>
            <p>Naming things is hard for me, because once I got an idea I can't forget it easily and I have to make everything related to it.</p>
            <p>As a sign of Destiny, as I began to search for a name one of moderator on the discord server wrote it's catchphrase : "<i>Beau gosse</i>"</p>
            <p><i>Beau gosse</i> is french  for "handsome (guy)" / "pretty boy" it can be used to actually describe a man with an attractive physical or to commemorate someone achieving a feat.</p>
            <p>I liked that name for all relation and the pun I could do on it. Having a "<i>beau gosse</i>" bringing porn on a server was a funny idea, at least to me.</p>
            <p>So now, I had the idea, the name and the motivation, it was time to jump.</p>
            <br>
            <p>Aug. 26, 2022, This is the birth of the project or at least the first time I committed the code to Github.</p>
            <p>I won't dive into the technical because I forgot all the ups and down I had to overcome during the development</p>
            <p>But on Sep. 1, 2022, I was faced with a hard issue.</p>
        </div>
    </section>

    <section class="section">
        <div class="container has-text-justify">
            <h4><u>2. Who are you ? And who I am to you ?</u></h4>
            <p>One of my goal with <i>beau gosse</i> was to be able to link a media (a video, a gif, an image) to it's source, for example either finding the subject of the artist.</p>
            <p>At the beginning I store every references inside a <code>json</code> file. <code>json</code> is a standard textual representation inspired from Javascript.</p>
            <p>The format has the advantage to be easily readable by humans and computers! Yet, there's one limit I didn't foresee.</p>
            <p>After a few days, the file became too big to open it. <i>Beau gosse</i> could write into it, but I couldn't look inside it.</p>
            <p>I could have written a piece of code to look for what I wanted, but it was pretty clear that soon enough the file would be too big too be usable.</p>
            <p>So, I devised a simple solution, rotate the files per date. Simple enough but another issue arise.</p>
            <p>I started to see double, even triple. Since I didn't check for previous days results, I could download the same medias over and over.</p>
            <p>So, instead of solving the issue, I just fragmented it. Reading a month worth of file would just required too much resources for my computer.</p>
            <p>So, for a few days, each time I started it, <i>Beau gosse</i> didn't remember a thing, and technically it's still doesn't.</p>
            <p>The actual solution was pretty obvious, at least for me, to solve the issue. Use a database to store the data.</p>
            <p>If I didn't do it as soon I got the issue, it's because I'm lazy.</p>
            <p><code>dart</code> the language I use to write <i>beau gosse</i> is AWFUL to work with database. I really hate that aspect of <code>dart</code></p>
            <p>But I know another language, better even a whole framework, which I found perfect to handle database operation : <code>Laravel</code></p>
            <p>But <code>Laravel</code> is a <code>php</code> framework, something used to do website among other things.</p>
            <p>I worked, work and will work with <code>Laravel</code> but bringing <code>dart</code> and <code>Laravel</code> together would require a lot of time and work.</p>
        </div>
    </section>

    <section class="section">
        <div class="container has-text-justify">
            <h4><u>3. <i>Belle Gosse</i></u></h4>
            <p>Like I said before, when I found a name for a project I need to link everything to it.</p>
            <p>Even before I started the project, the name was pretty obvious for me : <i>Belle gosse</i>.</p>
            <p><i>Belle gosse</i> have the same meaning that <i>beau gosse</i> except it's feminine.</p>
            <p>Aside from the joke and the mental need to link everything together, I loved the idea of having a couple : <i>beau gosse</i> and <i>belle gosse</i> working together as a single entity.</p>
            <p>If <i>beau gosse</i> would do the searching, downloading and sorting, <i>belle gosse</i> work would be to rembember it, to write down in the database.</p>
            <p>But as the quote say : "Men are from Mars, Women are from Venus", they both lived inside their own universe, their own language and I needed a bridge between them.</p>
          </div>
    </section>

    <section class="section">
        <div class="container has-text-justify">
            <h4><u>4. <i>Bel adn</i></u></h4>
            <p>Again a pun based on <i>beau gosse</i>, <i>bel adn</i> mean "beautiful DNA".</p>
            <p>Since this piece of code, this library handle the communication between <i>beau gosse</i> and <i>belle gosse</i> I loved how fitting the name was.</p>
            <p>Technically, <i>bel adn</i> is written in <code>dart</code> so it's closer to <i>beau gosse</i> but it's speak the same language as <i>belle gosse</i> so...</p>
            <p>As some may wonder why I din't named it "beautiful child" or something like that, it's because I reserve that name for something else and because even if I use the gendered version of the adjective, I never said they were actually male or female ;)</p>
            <p>Anyway, this simple project started to getting bigger and bigger, I had now three different pieces of software to handle and things started to get messy. So I took a pause to clean things up.</p>
        </div>
    </section>

    <section class="section">
        <div class="container has-text-justify">
            <h4><u>5. <i>Magnifique Couple</i></u></h4>
            <p>The first thing I did was to put every projects side to side inside a common meta project : Magnifque couple</p>
            <p>On Oct 5, 2022, I run for the first time , in production mode, the <i>Magnifique couple</i>.</p>
            <p>It's was also the first time, in my life, I had a project with multiple part not written in the same language.</p>
            <p>I was happy with my work, it worked.</p>
            <p>Indeed it worked, but as fast as a dead snail.</p>
            <p>At the time, I had around 25 <i>Topics</i> for around 50 <i>providers</i>. It took almost a full hour to complete an execution, IF it didn't crash in the middle.</p>
            <p>So after so memory issue, <i>beau gosse</i> was having a performance issue, like it's creator it's a good lover.</p>
        </div>
    </section>

    <section class="section">
        <div class="container has-text-justify">
            <h4><u>6. <i>One core to rule them all</i></u></h4>
            <p>Modern computer are being equipped with multi core CPU.</p>
            <p>To put it simply they have multiple physical "thinking" part on their chips.</p>
            <p>By design <code>dart</code> only run on one core, leaving the other to lay in the sun.</p>
            <p>The slowness of <i>beau gosse</i> came from that design. every thing was being proceed, one element at a time.</p>
            <p>To solve this issue, I had to rewrote the entire work logic so it could be split among my computer cores.</p>
            <p>After that felt like eternity, I commit the "Je n'ai pas eu le choix" (I didn't have the choice) update on Oct. 26, 2022.</p>
            <p>This update is named like this because I found (and spoiler it was) my solution ugly. Yet <i>beau gosse</i> was now running int ten minutes.</p>
            <p>The feeling of resolving such a technical issue was overhelming and I was thrilled yet also tired. And I decided it was enough to leave the code for the time being.</p>
        </div>
    </section>


    <section class="section">
        <div class="container has-text-justify">
            <h4><u>7. Swimming with sharks</u></h4>
            <p>Among my journey on Reddit I came across a sub dedicated to fan made alternative of my favorite series : The Elder Scrolls.</p>
            <p>From time to time I would talk with it(s member on the posts, very briefly until one day, the creator announced they opened a Discord server.</p>
            <p>I shrugged it off since I didn't feel close of them enough to join that place.</p>
            <p>Still one morning after joking for a few comments with said creator I asked them if I could get an invitation for the Discord.</p>
            <p>Writing that I was well welcomed would be an understatement.</p>
            <p>I can't put words on how much those peoples teached me, how I love them for being, well , themselves.</p>
            <p>It happened that server have also a dark place, some kind of jail where lustful entities are being rounded up.</p>
            <p>I feared to go there, to let that part of me, my perversion my sex addiction being seen.</p>
            <p>Yet I finally gave into my craving and , gods, I'm happy I did it.</p>
            <p>Those peoples not only accepted me but also offered something else, something they didn't know they would offer me : motivation.</p>
            <p>Motivation to work on <i>beau gosse again</i> to fulfill their fantasies.</p>
        </div>
    </section>

    <section class="section">
        <div class="container has-text-justify">
            <h4><u>8. Gardener of men</u></h4>
            <p>I worked hard to add the required element to <i>beau gosse</i> and still have them fit with the existing system.</p>
            <p>On May 15, 2023 I commited the first resolver dedicated to them.</p>
            <p>Their reactions were mind blowing.  I didn't did it for the praise but was praised.</p>
            <p>Soon after, I tweaked and added more resolvers and took for an habit two times a day to post my "hunt" as some sweet elf would call it.</p>
            <p>But happiness is only fading , isn't it ?</p>
        </div>
    </section>

    <section class="section">
        <div class="container has-text-justify">
            <h4><u>9. Ophélien "Shalien" DUPARC</u></h4>
            <p>As the moth of May 2023 ended, my personal life was kinda messy.</p>
            <p>I was about to enter a month long of school exams for my bachelor, the first summer heat was there and ... my old demons awoken.</p>
            <p>When I say demons, I should really say, part of me I prefer to forget about. Stressful, needy, nerdy and basically unable to sustain a basic conversdation.</p>
            <p>The stress of the exam was getting at me, by the past I fought it using games, masturbation, sex and so on but this nothing could push it back.</p>
            <p>And I know why, taking my bachelor after a ten years hiatus of any king of school was a trial. A trial I feared to lose.</p>
            <p>The only thing actually helping to calm down was working on <i>beau gosse</i> seeing peoples reacting to my post. Since it's was one way it helped me to actually feel better.</p>
            <p>Something I found funny, it's, generally, all the bad things come together.</p>
            <p>As the last week of june started, my actual exams did so. And this dreadful monday evening, ashamed of myself for my under performance, I tried to get good vibes from Discord.</p>
            <p>Since a few weeks <i>beau gosse</i> was acting up, the old flaws in it's design had became open wound spewing bugs and errors preventing me to actually getting usable medias for Discord.</p>
            <p>And I saw that as another proof of my failures. Even if I knew I wasn't not in the good state of mind for it I tried to talk with peoples on Discord, and failed.</p>
            <p>On the first server, I ended being called a "déchet" (waste) because I refused to admit that having an android phone was the proof of being a redneck (and I still stand on that position).</p>
            <p>I had been called countless things in my life but this one hitted me hard.</p>
            <p>On the second server .... I let my insecure self talk and made a fool of myself.</p>
            <p>On the second server .... I let my insecure self talk and made a fool of myself.</p>
            <p>To put the final touch of this catastrophic depiction of myself, I resorted to an egoist measure. I uninstalled Discord.</p>
            <p>I didn't have the strenght to look back at my mistakes.</p>
            <p>As a punishment for my behaviour I condmaned myself to an immense task : rewriting <i>Magnifique couple</i> from the ground</p>
        </div>
    </section>

    <section class="section">
        <div class="container has-text-justify">
            <h4><u>10. The story so far</u></h4>
            <p>So here we're again, it's always such a pleasure.</p>
            <p>On this day July 11, 2023, I finished the rewrote of <i>Magnifique Couple</i> and will push it to production.</p>
            <p>I wanted to thanks everybody who I pushed me this far and I hope you would be happy with the new version</p>
            <p>I've also generated an icon for the project using an AI.</p>
            <figure class="image is-128x128">
                <img src="./mc.png" alt="a magnifique couple">
            </figure>
        </div>
    </section>

    </body>
  </html>
